import streamlit as st
import mysql.connector
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
import numpy as np
from statsmodels.tsa.arima.model import ARIMA

# Cambiar importaciones
from sklearn.linear_model import LinearRegression
from sklearn.ensemble import RandomForestRegressor
from sklearn.cluster import KMeans  # Añadido KMeans
from sklearn.preprocessing import StandardScaler
from scipy import stats

# Agregar después de las importaciones
PLOT_STYLE = {
    "figure.figsize": (14, 8),
    "font.size": 16,  # Aumentado de 14 a 16
    "axes.titlesize": 20,  # Aumentado de 16 a 20
    "axes.labelsize": 18,  # Aumentado de 14 a 18
    "xtick.labelsize": 14,  # Aumentado de 12 a 14
    "ytick.labelsize": 14,  # Aumentado de 12 a 14
    "legend.fontsize": 16,  # Aumentado de 12 a 16
    "axes.linewidth": 1.5,
    "grid.linewidth": 0.8,
    "lines.linewidth": 2.5,  # Aumentado de 2 a 2.5
    "lines.markersize": 10,  # Aumentado de 8 a 10
}

# Aplicar estilo global para todas las gráficas
plt.rcParams.update(PLOT_STYLE)

MESES_ES = {
    1: "Enero",
    2: "Febrero",
    3: "Marzo",
    4: "Abril",
    5: "Mayo",
    6: "Junio",
    7: "Julio",
    8: "Agosto",
    9: "Septiembre",
    10: "Octubre",
    11: "Noviembre",
    12: "Diciembre",
}

MESES_ABREV = {
    1: "Ene",
    2: "Feb",
    3: "Mar",
    4: "Abr",
    5: "May",
    6: "Jun",
    7: "Jul",
    8: "Ago",
    9: "Sep",
    10: "Oct",
    11: "Nov",
    12: "Dic",
}


# Configuración de la conexión con MySQL
def create_connection():
    connection = mysql.connector.connect(
        host="localhost",  # Cambia esto a tu configuración
        user="root",
        password="root",
        database="tesisii",
    )
    return connection


# Función para obtener los datos de la base de datos
def get_data_from_sql(query):
    connection = create_connection()
    data = pd.read_sql(query, connection)
    connection.close()
    return data


# Función para predecir las ventas con ARIMA
def predict_sales(data, vista="Diaria", periods=7):
    df = data.copy()

    if vista == "Semanal":
        # Para vista semanal, crear índice temporal con semanas
        df["fecha"] = pd.to_datetime("2023-01-01") + pd.to_timedelta(
            df["semana"] * 7, unit="D"
        )
        df.set_index("fecha", inplace=True)
        series = df["ventas"].asfreq("W")
    else:
        # Para vista diaria
        df["fecha"] = pd.to_datetime(df["fecha"])
        df.set_index("fecha", inplace=True)
        series = df["ventas"]

    # Ajustar el modelo ARIMA
    model = ARIMA(series, order=(5, 1, 0))
    model_fit = model.fit()

    # Predicción
    forecast = model_fit.forecast(steps=periods)
    return forecast


# Reemplazar predict_with_prophet por nueva función de predicción
def predict_with_ml(data, vista_temporal="Semanal", current_period=None):
    """
    Predice solo períodos futuros basándose en el último dato real disponible
    """
    df = data.copy()
    df["fecha"] = pd.to_datetime(df["fecha"])

    # Obtener la última fecha de datos reales
    ultima_fecha_real = df["fecha"].max()

    # Verificar si estamos intentando predecir períodos pasados
    if current_period is not None:
        current_date = pd.to_datetime(current_period)
        if current_date < ultima_fecha_real:
            return None  # No predecir si es un período pasado

    # Configurar períodos futuros según la vista
    if vista_temporal == "Trimestral":
        # Encontrar el primer día del siguiente mes después del último mes
        siguiente_fecha = ultima_fecha_real + pd.offsets.MonthEnd(0) + pd.offsets.Day(1)
        meses_restantes = 3 - (siguiente_fecha.month % 3)
        periods = meses_restantes
        freq = "M"
    elif vista_temporal == "Mensual":
        # Encontrar el primer día de la siguiente semana
        siguiente_fecha = ultima_fecha_real + pd.Timedelta(
            days=(7 - ultima_fecha_real.weekday())
        )
        semanas_restantes = 5 - siguiente_fecha.isocalendar()[1] % 4
        periods = semanas_restantes
        freq = "W"
    else:  # Semanal
        siguiente_fecha = ultima_fecha_real + pd.Timedelta(days=1)
        dias_restantes = 7 - siguiente_fecha.weekday()
        periods = dias_restantes
        freq = "D"

    # Generar fechas futuras
    future_dates = pd.date_range(start=siguiente_fecha, periods=periods, freq=freq)

    # Preparar características para el modelo
    df["dia_semana"] = df["fecha"].dt.dayofweek
    df["mes"] = df["fecha"].dt.month
    df["dia_mes"] = df["fecha"].dt.day
    df["año"] = df["fecha"].dt.year
    df["semana"] = df["fecha"].dt.isocalendar().week
    df["trimestre"] = df["fecha"].dt.quarter

    # Calcular promedios móviles según la vista
    if vista_temporal == "Trimestral":
        ventana = 90
    elif vista_temporal == "Mensual":
        ventana = 30
    else:
        ventana = 7

    df["ventas_promedio"] = df["ventas"].rolling(ventana, min_periods=1).mean()
    df["ordenes_promedio"] = df["num_ordenes"].rolling(ventana, min_periods=1).mean()

    # Seleccionar características
    features = [
        "dia_semana",
        "mes",
        "dia_mes",
        "año",
        "semana",
        "trimestre",
        "num_ordenes",
        "ventas_promedio",
        "ordenes_promedio",
    ]

    X = df[features].fillna(method="ffill")
    y = df["ventas"]

    # Entrenar modelo
    model = RandomForestRegressor(n_estimators=200, max_depth=10, random_state=42)
    model.fit(X, y)

    # Preparar datos futuros
    future_df = pd.DataFrame(index=future_dates)
    future_df["fecha"] = future_df.index
    future_df["dia_semana"] = future_df["fecha"].dt.dayofweek
    future_df["mes"] = future_df["fecha"].dt.month
    future_df["dia_mes"] = future_df["fecha"].dt.day
    future_df["año"] = future_df["fecha"].dt.year
    future_df["semana"] = future_df["fecha"].dt.isocalendar().week
    future_df["trimestre"] = future_df["fecha"].dt.quarter

    # Usar promedios de los últimos datos como valores base
    future_df["num_ordenes"] = df["num_ordenes"].tail(ventana).mean()
    future_df["ventas_promedio"] = df["ventas"].tail(ventana).mean()
    future_df["ordenes_promedio"] = df["num_ordenes"].tail(ventana).mean()

    # Realizar predicción
    forecast = model.predict(future_df[features])

    return pd.Series(forecast, index=future_dates)


# Nueva función para análisis de patrones
def analyze_patterns(data):
    # Preparar datos
    scaler = StandardScaler()
    scaled_data = scaler.fit_transform(data[["ventas", "num_ordenes"]])

    # Aplicar K-means
    kmeans = KMeans(n_clusters=3, random_state=42)
    clusters = kmeans.fit_predict(scaled_data)

    # Añadir resultados al dataframe
    data["cluster"] = clusters

    # Análisis estadístico
    stats_summary = {
        "tendencia": stats.linregress(range(len(data["ventas"])), data["ventas"]),
        "estacionalidad": stats.pearsonr(data["ventas"], data["num_ordenes"]),
        "anomalias": stats.zscore(data["ventas"]),
    }

    return data, stats_summary


# Configuración de la aplicación Streamlit
st.set_page_config(page_title="Dashboard de Ventas", layout="wide")


st.title("📊 Dashboard de Ventas - El Rincón del Pato")

# Obtener datos iniciales para el dashboard
query_inicial = """
SELECT
    DATE(order_date) AS fecha,
    COUNT(*) AS num_ordenes,
    COALESCE(SUM(total), 0) AS ventas
FROM orders
WHERE payment_status = 'Pagado'
    AND order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)
GROUP BY DATE(order_date)
ORDER BY fecha DESC;
"""
data = get_data_from_sql(query_inicial)

# Crear tabs para mejor organización
tab1, tab2, tab3, tab4 = st.tabs(
    [
        "📈 Vista General",
        "🏆 Análisis de Productos",
        "📊 Métricas Comparativas",
        "📋 Datos Detallados",
    ]
)

with tab1:
    st.subheader("Panel General de Ventas")

    # Sección superior con KPIs principales
    col1, col2, col3, col4 = st.columns(4)
    with col1:
        st.metric("Ventas Totales", f"S/. {data['ventas'].sum():,.2f}")
    with col2:
        st.metric(
            "Ticket Promedio",
            f"S/. {(data['ventas'].sum() / data['num_ordenes'].sum()):,.2f}",
        )
    with col3:
        st.metric("Total Órdenes", f"{data['num_ordenes'].sum():,}")
    with col4:
        st.metric("Promedio Diario", f"S/. {data['ventas'].mean():,.2f}")

    # Sección de gráficos principales
    st.subheader("Tendencias y Predicciones")

    # Agregar filtros de tiempo
    filtros_col1, filtros_col2, filtros_col3 = st.columns(
        3
    )  # Cambiado de 4 a 3 columnas
    with filtros_col1:
        query_años = """
        SELECT DISTINCT YEAR(order_date) as año
        FROM orders
        WHERE payment_status = 'Pagado'
        ORDER BY año DESC
        """
        años_disponibles = get_data_from_sql(query_años)
        año_seleccionado = st.selectbox("Año", años_disponibles["año"].tolist())

    with filtros_col2:
        vista_temporal = st.selectbox(
            "Vista", ["Trimestral", "Mensual", "Semanal"], index=0
        )

    with filtros_col3:
        if vista_temporal == "Trimestral":
            trimestre_seleccionado = st.selectbox(
                "Trimestre", range(1, 5), format_func=lambda x: f"Q{x}"
            )
            periodo_label = "trimestre"
        elif vista_temporal == "Mensual":
            query_meses = f"""
            SELECT DISTINCT MONTH(order_date) as mes
            FROM orders
            WHERE YEAR(order_date) = {año_seleccionado}
            ORDER BY mes
            """
            meses_disponibles = get_data_from_sql(query_meses)
            mes_seleccionado = st.selectbox(
                "Mes",
                meses_disponibles["mes"].tolist(),
                format_func=lambda x: MESES_ES[x],
            )
            periodo_label = "mes"
        else:  # Semanal
            query_semanas = f"""
            SELECT DISTINCT
                WEEK(order_date) as semana
            FROM orders
            WHERE YEAR(order_date) = {año_seleccionado}
            ORDER BY semana
            """
            semanas_disponibles = get_data_from_sql(query_semanas)
            semana_seleccionada = st.selectbox(
                "Semana",
                semanas_disponibles["semana"].tolist(),
                format_func=lambda x: f"Semana {x}",
            )
            periodo_label = "semana"

    # Modificar las queries según la vista
    if vista_temporal == "Trimestral":
        query_tendencia = f"""
        SELECT
            DATE_FORMAT(order_date, '%Y-%m-01') AS fecha,
            MONTH(order_date) AS mes,
            COUNT(*) AS num_ordenes,
            COALESCE(SUM(total), 0) AS ventas
        FROM orders
        WHERE payment_status = 'Pagado'
            AND YEAR(order_date) = {año_seleccionado}
            AND QUARTER(order_date) = {trimestre_seleccionado}
        GROUP BY DATE_FORMAT(order_date, '%Y-%m-01'), MONTH(order_date)
        ORDER BY fecha
        """
    elif vista_temporal == "Mensual":
        query_tendencia = f"""
        SELECT
            DATE(MIN(order_date)) AS fecha,
            WEEK(order_date) AS semana,
            COUNT(*) AS num_ordenes,
            COALESCE(SUM(total), 0) AS ventas
        FROM orders
        WHERE payment_status = 'Pagado'
            AND YEAR(order_date) = {año_seleccionado}
            AND MONTH(order_date) = {mes_seleccionado}
        GROUP BY WEEK(order_date)
        ORDER BY semana
        """
    else:  # Semanal
        query_tendencia = f"""
        SELECT
            DATE(order_date) AS fecha,
            DAYOFWEEK(order_date) AS dia,
            COUNT(*) AS num_ordenes,
            COALESCE(SUM(total), 0) AS ventas
        FROM orders
        WHERE payment_status = 'Pagado'
            AND YEAR(order_date) = {año_seleccionado}
            AND WEEK(order_date) = {semana_seleccionada}
        GROUP BY DATE(order_date), DAYOFWEEK(order_date)
        ORDER BY fecha
        """

    data_tendencia = get_data_from_sql(query_tendencia)
    data_tendencia["fecha"] = pd.to_datetime(data_tendencia["fecha"])

    col1, col2 = st.columns(2)
    with col1:
        st.write(f"📈 Tendencia de Ventas por {vista_temporal}")

        if len(data_tendencia) == 0:
            st.warning("No hay datos disponibles para el período seleccionado.")
        else:
            fig = plt.figure(figsize=(14, 8))

            # Ajustar el formato de las etiquetas del eje x según la vista
            if vista_temporal == "Trimestral":
                x_labels = [MESES_ES[fecha.month] for fecha in data_tendencia["fecha"]]
            elif vista_temporal == "Mensual":
                x_labels = [f"Semana {week}" for week in data_tendencia["semana"]]
            else:  # Semanal
                x_labels = [
                    fecha.strftime("%d-%b") for fecha in data_tendencia["fecha"]
                ]

            # Verificar si hay valores válidos antes de graficar
            if data_tendencia["ventas"].notna().any():
                plt.plot(
                    range(len(data_tendencia)),
                    data_tendencia["ventas"],
                    marker="o",
                    linewidth=2.5,
                    markersize=10,
                    label="Ventas Reales",
                )

                # Calcular límites del eje y solo con valores válidos
                ventas_validas = data_tendencia["ventas"].dropna()
                if len(ventas_validas) > 0:
                    y_min = max(
                        0, ventas_validas.min() * 0.9
                    )  # No permitir valores negativos
                    y_max = ventas_validas.max() * 1.1

                    # Configurar límites del eje y
                    plt.ylim(y_min, y_max)

                    # Agregar valores sobre los puntos
                    for x, y in zip(
                        range(len(data_tendencia)), data_tendencia["ventas"]
                    ):
                        if pd.notna(y):  # Solo agregar etiquetas para valores válidos
                            plt.annotate(
                                f"S/. {y:,.0f}",
                                (x, y),
                                textcoords="offset points",
                                xytext=(0, 10),
                                ha="center",
                                fontsize=10,
                            )

                # Configurar eje x
                plt.xticks(
                    range(len(data_tendencia)), x_labels, rotation=45, ha="right"
                )

                plt.title(
                    f"Tendencia de Ventas {vista_temporal}s ({año_seleccionado})",
                    pad=20,
                    fontsize=20,
                    fontweight="bold",
                )
                plt.xlabel("Fecha", fontsize=18, labelpad=10, fontweight="bold")
                plt.ylabel("Ventas (S/.)", fontsize=18, labelpad=10, fontweight="bold")
                plt.grid(True, linestyle="--", alpha=0.7)
                plt.legend(fontsize=16, loc="upper right")

                # Ajustar márgenes y espaciado
                plt.tight_layout()
                st.pyplot(fig)

                # Guardar los límites para la siguiente gráfica
                ylims = plt.gca().get_ylim()
                yticks = plt.gca().get_yticks()

            else:
                st.warning(
                    "No hay valores válidos para graficar en el período seleccionado."
                )

            # Restaurar descripción estadística solo si hay datos válidos
            if len(data_tendencia) > 1 and data_tendencia["ventas"].notna().any():
                col_stats1, col_stats2 = st.columns(2)
                with col_stats1:
                    # Mostrar estadísticas de tendencia
                    tendencia = stats.linregress(
                        range(len(data_tendencia["ventas"])),
                        data_tendencia["ventas"].fillna(
                            method="ffill"
                        ),  # Rellenar NaN para el cálculo
                    )
                    st.write(
                        f"📊 Tendencia: {'Positiva ↗️' if tendencia.slope > 0 else 'Negativa ↘️'}"
                    )
                    st.write(
                        f"Variación promedio diaria: S/. {abs(tendencia.slope):,.2f}"
                    )

                with col_stats2:
                    # Calcular y mostrar variación porcentual
                    variacion = (
                        (
                            data_tendencia["ventas"].iloc[-1]
                            / data_tendencia["ventas"].iloc[0]
                        )
                        - 1
                    ) * 100
                    st.write(f"📈 Variación total: {variacion:.1f}%")
                    st.write(
                        f"Promedio de ventas: S/. {data_tendencia['ventas'].mean():,.2f}"
                    )

    with col2:
        st.write("🔮 Predicción de Ventas")

        try:
            # Modificar las queries para obtener solo datos hasta el período actual
            if vista_temporal == "Trimestral":
                query_historico = f"""
                SELECT
                    DATE(order_date) AS fecha,
                    COUNT(*) AS num_ordenes,
                    COALESCE(SUM(total), 0) AS ventas
                FROM orders
                WHERE payment_status = 'Pagado'
                    AND YEAR(order_date) = {año_seleccionado}
                    AND QUARTER(order_date) <= {trimestre_seleccionado}
                GROUP BY DATE(order_date)
                HAVING fecha <= CURRENT_DATE()
                ORDER BY fecha
                """
            elif vista_temporal == "Mensual":
                query_historico = f"""
                SELECT
                    DATE(order_date) AS fecha,
                    COUNT(*) AS num_ordenes,
                    COALESCE(SUM(total), 0) AS ventas
                FROM orders
                WHERE payment_status = 'Pagado'
                    AND YEAR(order_date) = {año_seleccionado}
                    AND MONTH(order_date) = {mes_seleccionado}
                GROUP BY DATE(order_date)
                HAVING fecha <= CURRENT_DATE()
                ORDER BY fecha
                """
            else:  # Semanal
                query_historico = f"""
                SELECT
                    DATE(order_date) AS fecha,
                    COUNT(*) AS num_ordenes,
                    COALESCE(SUM(total), 0) AS ventas
                FROM orders
                WHERE payment_status = 'Pagado'
                    AND YEAR(order_date) = {año_seleccionado}
                    AND WEEK(order_date) = {semana_seleccionada}
                GROUP BY DATE(order_date)
                HAVING fecha <= CURRENT_DATE()
                ORDER BY fecha
                """

            data_historico = get_data_from_sql(query_historico)

            # Verificar si estamos en un período actual o futuro
            ultima_fecha_real = data_historico["fecha"].max()
            fecha_actual = pd.Timestamp.now().date()

            if pd.to_datetime(ultima_fecha_real).date() < fecha_actual:
                # Calcular predicciones solo si estamos en el período actual
                forecast_ml = predict_with_ml(
                    data_historico,
                    vista_temporal=vista_temporal,
                    current_period=ultima_fecha_real,
                )

                if forecast_ml is not None:
                    # Crear gráfica de predicciones
                    fig = plt.figure(figsize=(14, 8))

                    # Ajustar etiquetas según la vista
                    if vista_temporal == "Trimestral":
                        x_labels = [
                            f"{MESES_ES[date.month]}" for date in forecast_ml.index
                        ]
                        titulo = "Meses restantes del trimestre"
                    elif vista_temporal == "Mensual":
                        x_labels = [
                            f"Semana {date.isocalendar()[1]}"
                            for date in forecast_ml.index
                        ]
                        titulo = "Semanas restantes del mes"
                    else:
                        x_labels = [
                            date.strftime("%d-%b") for date in forecast_ml.index
                        ]
                        titulo = "Días restantes de la semana"

                    plt.plot(
                        range(len(forecast_ml)),
                        forecast_ml.values,
                        "r--",
                        marker="o",
                        label="Predicción",
                        linewidth=3,
                        markersize=10,
                        color="red",
                    )

                    # Configurar gráfica
                    plt.xticks(
                        range(len(forecast_ml)), x_labels, rotation=45, ha="right"
                    )
                    plt.title(
                        f"Predicción de Ventas\n{titulo}",
                        pad=20,
                        fontsize=20,
                        fontweight="bold",
                    )
                    plt.xlabel("Período", fontsize=18, labelpad=10, fontweight="bold")
                    plt.ylabel(
                        "Ventas Estimadas (S/.)",
                        fontsize=18,
                        labelpad=10,
                        fontweight="bold",
                    )
                    plt.grid(True, linestyle="--", alpha=0.7)

                    # Agregar valores sobre los puntos
                    for x, y in zip(range(len(forecast_ml)), forecast_ml.values):
                        plt.annotate(
                            f"S/. {y:,.0f}",
                            (x, y),
                            textcoords="offset points",
                            xytext=(0, 10),
                            ha="center",
                            color="red",
                            fontsize=12,
                            fontweight="bold",
                        )

                    plt.tight_layout()
                    st.pyplot(fig)

                    # Mostrar tabla de predicciones
                    st.write(f"📅 Predicciones por {vista_temporal.lower()}:")
                    if vista_temporal == "Trimestral":
                        formato_fecha = "%B %Y"
                    elif vista_temporal == "Mensual":
                        formato_fecha = "Semana %W"
                    else:
                        formato_fecha = "%d-%b"

                    predicciones_df = pd.DataFrame(
                        {
                            "Período": [
                                d.strftime(formato_fecha) for d in forecast_ml.index
                            ],
                            "Venta Estimada": [
                                f"S/. {x:,.2f}" for x in forecast_ml.values
                            ],
                        }
                    )
                    st.dataframe(predicciones_df)

                else:
                    st.info("No se muestran predicciones para períodos pasados.")
            else:
                st.info(
                    "No hay predicciones disponibles para este período ya que ya tenemos datos reales."
                )

        except Exception as e:
            st.warning(f"No hay suficientes datos para generar predicciones: {str(e)}")
            st.info(
                "Se necesitan datos históricos suficientes para generar predicciones confiables."
            )

with tab2:
    st.subheader("Análisis Detallado de Productos")

    # Selector de vista
    vista_productos = st.radio(
        "Seleccione vista",
        ["Top Productos", "Por Categoría", "Análisis de Rendimiento"],
        horizontal=True,
    )

    if vista_productos == "Top Productos":
        query_top = """
        SELECT mi.name AS platillo,
               COALESCE(SUM(oi.quantity), 0) AS cantidad_vendida,
               COALESCE(SUM(oi.quantity * oi.price), 0) AS ingresos_totales
        FROM menu_items mi
        LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
        LEFT JOIN orders o ON oi.order_id = o.id
        WHERE o.payment_status = 'Pagado'
        GROUP BY mi.name
        ORDER BY cantidad_vendida DESC
        LIMIT 10;
        """
        data_top = get_data_from_sql(query_top)

        col1, col2 = st.columns(2)
        with col1:
            st.write("🏆 Top 10 Productos más Vendidos")
            fig = plt.figure(figsize=(10, 6))
            sns.barplot(data=data_top, x="cantidad_vendida", y="platillo")
            plt.title("Productos más Vendidos")
            st.pyplot(fig)

        with col2:
            st.write("💰 Top 10 Productos por Ingresos")
            fig = plt.figure(figsize=(10, 6))
            sns.barplot(
                data=data_top.sort_values("ingresos_totales", ascending=False),
                x="ingresos_totales",
                y="platillo",
            )
            plt.title("Productos con Mayores Ingresos")
            st.pyplot(fig)

    elif vista_productos == "Por Categoría":
        query_cat = """
        SELECT
            c.name AS categoria,
            COUNT(oi.id) AS total_ordenes,
            COALESCE(SUM(oi.quantity * oi.price), 0) AS total_ventas
        FROM categories c
        LEFT JOIN menu_items mi ON c.id = mi.category_id
        LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
        LEFT JOIN orders o ON oi.order_id = o.id
        WHERE o.payment_status = 'Pagado'
        GROUP BY c.name
        ORDER BY total_ventas DESC;
        """
        data_cat = get_data_from_sql(query_cat)

        col1, col2 = st.columns(2)
        with col1:
            st.write("📊 Distribución por Categoría")
            fig = plt.figure(figsize=(10, 6))
            plt.pie(
                data_cat["total_ventas"],
                labels=data_cat["categoria"],
                autopct="%1.1f%%",
            )
            plt.title("Distribución de Ventas por Categoría")
            st.pyplot(fig)

        with col2:
            st.write("📈 Rendimiento por Categoría")
            fig = plt.figure(figsize=(10, 6))
            sns.barplot(data=data_cat, x="total_ventas", y="categoria")
            plt.title("Ventas Totales por Categoría")
            st.pyplot(fig)

    else:  # Análisis de Rendimiento
        query_rend = """
        SELECT
            mi.name as platillo,
            COUNT(oi.id) as veces_ordenado,
            SUM(oi.quantity) as unidades_vendidas,
            SUM(oi.quantity * oi.price) as ingresos_totales,
            c.name as categoria
        FROM menu_items mi
        LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
        LEFT JOIN orders o ON oi.order_id = o.id
        LEFT JOIN categories c ON mi.category_id = c.id
        WHERE o.payment_status = 'Pagado'
        GROUP BY mi.name, c.name
        ORDER BY ingresos_totales DESC;
        """
        data_rend = get_data_from_sql(query_rend)

        # Métricas de rendimiento
        col1, col2, col3 = st.columns(3)
        with col1:
            st.metric(
                "Producto Más Vendido",
                data_rend["platillo"].iloc[0],
                f"{data_rend['unidades_vendidas'].iloc[0]} unidades",
            )
        with col2:
            st.metric(
                "Mayor Ingreso", f"S/. {data_rend['ingresos_totales'].max():,.2f}"
            )
        with col3:
            st.metric(
                "Promedio de Pedidos", f"{data_rend['veces_ordenado'].mean():.0f}"
            )

        # Gráfico de dispersión
        st.write("🎯 Análisis de Rendimiento")
        fig = plt.figure(figsize=(12, 6))
        plt.scatter(data_rend["veces_ordenado"], data_rend["ingresos_totales"])
        plt.xlabel("Frecuencia de Pedidos")
        plt.ylabel("Ingresos Totales (S/.)")
        plt.title("Relación entre Frecuencia de Pedidos e Ingresos")
        st.pyplot(fig)

with tab3:
    st.subheader("Métricas Comparativas")

    # Selector de período y tipo de análisis
    col1, col2 = st.columns(2)
    with col1:
        periodo = st.selectbox("Seleccionar período", ["Diario", "Semanal", "Mensual"])
    with col2:
        tipo_comparacion = st.selectbox(
            "Tipo de comparación",
            ["Ventas vs Órdenes", "Rendimiento por Día", "Análisis de Patrones"],
        )

    # Obtener datos según el período seleccionado
    if periodo == "Semanal":
        query_comp = """
        SELECT
            WEEK(order_date) as periodo,
            COUNT(*) as num_ordenes,
            SUM(total) as total_ventas,
            AVG(total) as ticket_promedio
        FROM orders
        WHERE payment_status = 'Pagado'
        GROUP BY WEEK(order_date)
        ORDER BY periodo DESC
        LIMIT 12
        """
    elif periodo == "Mensual":
        query_comp = """
        SELECT
            DATE_FORMAT(order_date, '%Y-%m') as periodo,
            COUNT(*) as num_ordenes,
            SUM(total) as total_ventas,
            AVG(total) as ticket_promedio
        FROM orders
        WHERE payment_status = 'Pagado'
        GROUP BY DATE_FORMAT(order_date, '%Y-%m')
        ORDER BY periodo DESC
        LIMIT 12
        """
    else:  # Diario
        query_comp = """
        SELECT
            DATE(order_date) as periodo,
            COUNT(*) as num_ordenes,
            SUM(total) as total_ventas,
            AVG(total) as ticket_promedio
        FROM orders
        WHERE payment_status = 'Pagado'
        GROUP BY DATE(order_date)
        ORDER BY periodo DESC
        LIMIT 30
        """

    data_comp = get_data_from_sql(query_comp)

    # Visualización según tipo de comparación
    col1, col2 = st.columns(2)

    with col1:
        if tipo_comparacion == "Ventas vs Órdenes":
            st.write("📊 Relación Ventas-Órdenes")
            fig = plt.figure(figsize=(10, 6))
            plt.scatter(data_comp["num_ordenes"], data_comp["total_ventas"])
            plt.xlabel("Número de Órdenes")
            plt.ylabel("Ventas Totales (S/.)")
            z = np.polyfit(data_comp["num_ordenes"], data_comp["total_ventas"], 1)
            p = np.poly1d(z)
            plt.plot(
                data_comp["num_ordenes"], p(data_comp["num_ordenes"]), "r--", alpha=0.8
            )
            st.pyplot(fig)

        elif tipo_comparacion == "Rendimiento por Día":
            st.write("📈 Rendimiento Diario")
            fig = plt.figure(figsize=(10, 6))
            sns.boxplot(data=data_comp, y="total_ventas")
            plt.title("Distribución de Ventas")
            st.pyplot(fig)

        else:  # Análisis de Patrones
            st.write("🔍 Patrones Identificados")
            data_patterns, stats = analyze_patterns(data_comp)
            fig = plt.figure(figsize=(10, 6))
            plt.scatter(
                data_patterns["num_ordenes"],
                data_patterns["total_ventas"],
                c=data_patterns["cluster"],
            )
            plt.xlabel("Número de Órdenes")
            plt.ylabel("Ventas Totales (S/.)")
            plt.title("Clusters de Comportamiento")
            st.pyplot(fig)

    with col2:
        st.write("📊 Métricas de Rendimiento")
        # Mostrar KPIs comparativos
        col1, col2 = st.columns(2)
        with col1:
            st.metric(
                "Promedio de Ventas",
                f"S/. {data_comp['total_ventas'].mean():,.2f}",
                f"{((data_comp['total_ventas'].iloc[0] / data_comp['total_ventas'].mean()) - 1) * 100:.1f}%",
            )
            st.metric(
                "Ticket Promedio", f"S/. {data_comp['ticket_promedio'].mean():,.2f}"
            )
        with col2:
            st.metric(
                "Órdenes Promedio",
                f"{data_comp['num_ordenes'].mean():.0f}",
                f"{((data_comp['num_ordenes'].iloc[0] / data_comp['num_ordenes'].mean()) - 1) * 100:.1f}%",
            )

with tab4:
    st.subheader("Datos Detallados")

    # Selector de vista de datos
    vista_datos = st.radio(
        "Seleccione tipo de datos",
        ["Ventas", "Productos", "Categorías", "Órdenes"],
        horizontal=True,
    )

    # Filtros superiores
    col1, col2, col3 = st.columns(3)
    with col1:
        fecha_filtro = st.date_input("Filtrar por fecha")
    with col2:
        # Obtener categorías para el filtro
        query_cats = "SELECT DISTINCT name FROM categories ORDER BY name"
        cats_data = get_data_from_sql(query_cats)
        categoria_filtro = st.multiselect(
            "Filtrar por categoría", options=cats_data["name"].tolist()
        )
    with col3:
        busqueda = st.text_input("Buscar", "")

    # Mostrar datos según la vista seleccionada
    if vista_datos == "Ventas":
        query_ventas = """
        SELECT DATE(order_date) as fecha,
               COUNT(*) as num_ordenes,
               SUM(total) as total_ventas,
               AVG(total) as ticket_promedio
        FROM orders
        WHERE payment_status = 'Pagado'
        GROUP BY DATE(order_date)
        ORDER BY fecha DESC
        """
        data_ventas = get_data_from_sql(query_ventas)
        st.write("📊 Registro de Ventas")
        st.dataframe(data_ventas)

    elif vista_datos == "Productos":
        query_productos = """
        SELECT
            mi.name as producto,
            c.name as categoria,
            COUNT(DISTINCT oi.id) as veces_vendido,
            COALESCE(SUM(oi.quantity), 0) as unidades_vendidas,
            COALESCE(MAX(oi.price), 0) as ultimo_precio
        FROM menu_items mi
        LEFT JOIN categories c ON mi.category_id = c.id
        LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
        GROUP BY mi.name, c.name
        ORDER BY unidades_vendidas DESC;
        """
        data_productos = get_data_from_sql(query_productos)

        # Formatear la presentación de los datos
        st.write("🍽️ Catálogo de Productos")
        formatted_data = data_productos.copy()
        formatted_data["ultimo_precio"] = formatted_data["ultimo_precio"].apply(
            lambda x: f"S/. {x:,.2f}"
        )
        st.dataframe(
            formatted_data,
            column_config={
                "producto": "Producto",
                "categoria": "Categoría",
                "veces_vendido": "Nº Pedidos",
                "unidades_vendidas": "Unidades Vendidas",
                "ultimo_precio": "Último Precio",
            },
        )

    elif vista_datos == "Categorías":
        query_categorias = """
        SELECT c.name as categoria,
               COUNT(DISTINCT mi.id) as num_productos,
               COUNT(oi.id) as num_ventas,
               COALESCE(SUM(oi.quantity * oi.price), 0) as ingresos_totales
        FROM categories c
        LEFT JOIN menu_items mi ON c.id = mi.category_id
        LEFT JOIN order_items oi ON mi.id = oi.menu_item_id
        GROUP BY c.name
        """
        data_categorias = get_data_from_sql(query_categorias)
        st.write("📑 Resumen por Categorías")
        st.dataframe(data_categorias)

    else:  # Órdenes
        query_ordenes = """
        SELECT o.id as orden_id,
               o.order_date as fecha,
               o.total,
               o.payment_status,
               COUNT(oi.id) as num_items
        FROM orders o
        LEFT JOIN order_items oi ON o.id = oi.order_id
        GROUP BY o.id, o.order_date, o.total, o.payment_status
        ORDER BY o.order_date DESC
        LIMIT 1000
        """
        data_ordenes = get_data_from_sql(query_ordenes)
        st.write("📝 Registro de Órdenes")
        st.dataframe(data_ordenes)

    # Opción para descargar datos
    if st.checkbox("Mostrar opciones de descarga"):
        # Obtener los datos actuales según la vista seleccionada
        data_to_download = None
        if vista_datos == "Ventas":
            data_to_download = data_ventas
        elif vista_datos == "Productos":
            data_to_download = data_productos
        elif vista_datos == "Categorías":
            data_to_download = data_categorias
        else:
            data_to_download = data_ordenes

        if data_to_download is not None:
            st.download_button(
                f"Descargar datos de {vista_datos}",
                data_to_download.to_csv(index=False).encode("utf-8"),
                f"datos_{vista_datos.lower()}.csv",
                "text/csv",
            )
