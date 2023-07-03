function confirmar(id){
swal({
    title: "Estás seguro de que quiere eliminar?",
    text: "",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      swal("Eliminando registro...", {
        icon: "success",
      });
    } else {
      swal("Eliminacion cancelada");
    }
  });
}