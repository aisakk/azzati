<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
   <div class="container-form flex flex-col justify-center content-center place-items-center h-screen">
    <img src="" alt="qrcode" id="img" class="hidden">
    <form  id="formulario" action="" class="flex flex-col h-auto w-60 gap-5 shadow-lg shadow-gray-250 px-5 py-2 rounded-md">
        <div class="flex flex-col">
            <label for="">Nombre</label>
            <input name="nombre" type="text" class="shadow-lg shadow-gray-200">
        </div>
        <div class="input flex flex-col">
            <label for="">Cantidad</label>
            <input name="cantidad" type="number" class="shadow-lg shadow-gray-200">
        </div>
        <div class="input flex flex-col">
            <label for="">Telefono</label>
            <input name="telefono" type="text" class="shadow-lg shadow-gray-200">
        </div>
        <button type="submit" class="rounded-lg w-50 bg-blue-500 hover:bg-blue-300 text-white py-2">Enviar</button>
    </form>

   </div>
   <script>

     let formulario = document.getElementById('formulario');
    let inputs = formulario.querySelectorAll("input")
    let token = "sWCkATuQlzT2solMGTM8BumHnr5CcKtrl70r3kVAK6wuVHPq2nAq1O2M0D4w"
    let img = document.getElementById("img")
    const formData = {};
    formulario.addEventListener("submit", (e)=>{
            e.preventDefault();
            inputs.forEach(input => {
            const name = input.name;
            const value = input.value;
             formData[name] = value;
            });
            fetch('/rapidprest_i2/api/', {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
                })
                .then(res =>res.json())
                .then(data =>{
                    img.classList.remove('hidden')
                    img.classList.add('block')
                    img.src = data.data
                })
                .catch(function(error) {
                    console.log(error);
                });
     })

   </script>
</body>
</html>
