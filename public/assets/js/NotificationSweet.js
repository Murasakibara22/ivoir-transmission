document.addEventListener('livewire:init', () => {
    Livewire.on('swal:modalGetInfo_message', (event) => {
        const data = event

        swal.fire({
            title : data[0]['title'],
            icon : data[0]['type'],
            text : data[0]['text'],
            timer: 2000,
            timerProgressBar: true,
        });
    });

    Livewire.on('swal:modalGetInfo_message_not_timer', (event) => {
        const data = event

        swal.fire({
            title : data[0]['title'],
            icon : data[0]['type'],
            text : data[0]['text'],
            timerProgressBar: true,
        });
    });

    Livewire.on('delete-pro', (event) => {
        swal.fire({
            title: "Are you sure ?",
            text : "Vous allez blabla bla",
            icon: "warning",
            showCancelButton : true,
            confirmButtonColor : "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText : "oui je veux",
            focusCancel: true ,
        }).then((result) => {
            if(result.isConfirmed){
                Livewire.dispatch('allezDelete')
            }
        })
    })

    Livewire.on('OpenModalModilEdit', (event) => {
        $("#"+event[0].name_modal).modal('show');
    })

    Livewire.on('OpenOffcanvas', (event) => {
        let offcanvasElement = document.getElementById(event[0].id_offcanvas);
        let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
        offcanvas.show();
    });

    Livewire.on('resetSummernote', (event) => {
        $('#'+event[0].name_summernote).summernote('reset');
    })

    //send le contenue de la decription dans le summernote de modifcation
    Livewire.on('contenuModifieSweetAlert',  (event) => {
        $('#'+event[0].name_summernote).summernote('code',event[0].content);
    });

    Livewire.on('closeModalModilEdit', (event) => {
        $("#"+event[0].name_modal).modal('hide');
    })

    Livewire.on('modalShowmessageToast', (event) => {
        const Toast = swal.mixin({
            toast: true,
            position: event[0].position,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: event[0].type,
            title: event[0].title
          });
    })

    Livewire.on('swal:modalDeleteOptions', (event) => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger me-3"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: event[0].title,
            text: event[0].text,
            icon: event[0].type,
            showCancelButton: true,
            confirmButtonText: "Oui, Suprimer !",
            cancelButtonText: "Non, Fermer!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                console.log(event[0].eventRetour);
                Livewire.dispatch(event[0].eventRetour, { id: event[0].id} )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire({
                title: "Anuler",
                text: "Cette action vient d'être annulée",
                icon: "error"
              });
            }
          });
    })

    Livewire.on('swal:modalConfirmOptions', (event) => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger me-3"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: event[0].title,
            text: event[0].text,
            icon: event[0].type,
            showCancelButton: true,
            confirmButtonText: "Oui, Confirmer !",
            cancelButtonText: "Non, Annuler!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                console.log(event[0].eventRetour);
                Livewire.dispatch(event[0].eventRetour, { id: event[0].id} )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire({
                title: "Anuler",
                text: "Cette action vient d'être annulée",
                icon: "error"
              });
            }
          });
    })



});
