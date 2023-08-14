import mysql.connector
from fpdf import FPDF

# Crear la conexión a la base de datos (MySQL)
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="testpython"
)

# Crear tabla si no existe
cursor = conn.cursor()
cursor.execute('''CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(255) NOT NULL,
                edad INT NOT NULL)''')

# Insertar registros en la tabla 'usuarios'
datos_usuarios = [('Juan', 25), ('María', 30), ('Pedro', 40)]
insert_query = "INSERT INTO usuarios (nombre, edad) VALUES (%s,%s)"
cursor.executemany(insert_query , datos_usuarios)

# Guardar los cambios y cerrar la conexión con la base de datos
conn.commit()
conn.close()

class PDF(FPDF):
    def header(self):
        self.set_font('Arial', 'B', 12)
        self.cell(0, 10, 'Listado Usuarios', align='C')

    def footer(self):
        self.set_y(-15)
        self.set_font('Arial', 'I', 8)
        self.cell(0, 10,'Página %s' % str(self.page_no()), align='C')

    def chapter_title(self):
        # Obtener los registros desde la base de datos
        conn = mysql.connector.connect(
            host="localhost",
            user="tu_usuario",
            password="tu_contraseña",
            database="nombre_base_de_datos"
        )
        
        cursor = conn.cursor()
        select_query = "SELECT * FROM usuarios"
        cursor.execute(select_query)
        
        registros = cursor.fetchall()

        # Agregar los registros al archivo PDF
        self.set_font('Arial', 'B', 12)
        self.cell(0, 10, 'Usuarios:', ln=True)

         for registro in registros:
             self.set_font('Arial', '', 12)
             self.cell(0, 10, f'ID: {registro[0]}, Nombre: {registro[1]}, Edad: {registro[2]}', ln=True)

# Crear una instancia de la clase PDF y generar el archivo
pdf = PDF()
pdf.add_page()
pdf.chapter_title()
pdf.output('usuarios.pdf')