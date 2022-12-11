import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
  headers: {
    'X-CSRF-TOKEN' : "{{csrf_token()}}"
  },
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
      if(document.querySelector('[name="imagen"]').value.trim()){
        const imagenPublicada = {}
        imagenPublicada.size = 1234;
        imagenPublicada.name = document.querySelector('[name="imagen"]').value;

        this.options.addedfile.call(this, imagenPublicada);
        this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

        imagenPublicada.previewElement.classList.add(
           "dz-success",
           "dz-complete"
        );
      }
    },
});


dropzone.on('success', function(file, response){
  console.log(response.imagen);
  //AQUI ENLAZAMOS LOS ARCHIVOS DE DROPZONE CON EL INPUT ESCONDIDO TIPO IMAGEN DEL "create.blade.php"
  document.querySelector('[name="imagen"]').value = response.imagen;
})

dropzone.on('removedfile', function(){
    console.log('Archivo Eliminado');
    document.querySelector('[name="imagen"]').value = ''; 
})


console.log('2) MENSAJE DESDE LA CARPETA: resources/js/app.js');