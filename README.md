# Proyecto: Cálculo de Calificaciones

## Descripción
Software que calcula el promedio de alumnos y determina si aprobaron o reprobaron. Está desarrollado en **PHP** y **JavaScript**, con conexión a **SQL Server** y una interfaz gráfica básica.

## Funcionalidades
- Calcular promedio de tareas:  
*Promedio = (((tarea_a * 17%) + (tarea_b * 18%) + (tarea_c * 25%)) * 100) / 60

markdown
Copiar código
- Validación de aprobación (mínimo 70), considerando:
- Tareas: 60%
- Proyectos: 40% (Proyecto1=10, Proyecto2=18, Proyecto3=12)
- Listas generadas en la interfaz:
- Todos los alumnos  
- Alumnos aprobados  
- Alumnos reprobados  
- Estado general (aprobado/reprobado)

## Instalación
1. Ejecutar el script SQL para crear la base de datos y tablas.  
2. Configurar conexión a SQL Server en `config.php`.  
3. Abrir el proyecto en un servidor local con soporte PHP.

## Uso
- Ingresar calificaciones de alumnos.  
- Visualizar listas y resultados en la interfaz.  
- Verificar aprobados y reprobados según criterios.

## Optimización
Evaluado con **Chrome DevTools** y **Core Web Vitals**:  
- LCP, CLS e INP para medir rendimiento y experiencia de usuario.

##Integrantes
-Leonardo Melchor Borges Pech
-Karina Michell Franco Tello
