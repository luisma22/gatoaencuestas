<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang='en' dir="{{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Gato Encuestas
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    @livewireStyles
</head>
<body class="g-sidenav-show {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }} {{ Route::currentRouteName() == 'register' || Route::currentRouteName() == 'static-sign-up'  ? '' : 'bg-gray-200' }}">

{{ $slot }}

<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
@stack('js')
<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
@livewireScripts
<script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.2.0/dist/livewire-sortable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script type="text/javascript">
$(document).ready(function() {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
    });
    
    $(".linkencuesta").click(async function(e) {
        e.preventDefault();
        await navigator.clipboard.writeText($(this).text());
        $("#toast").toast('show');
    })

    window.addEventListener('encuestas', event => {
        if ($(".modal-backdrop").length) {
            $(".modal-backdrop")[0].remove();
        }
        $('#exampleModal').modal('hide');
        $('#verEncuesta').modal('dispose');
        $('#offcanvasExample').offcanvas('hide');
        $('#offcanvasExample1').offcanvas('hide');
        Swal.fire({
            icon: 'success',
            title: 'La encuesta fue ' + event.detail +  ' exitosamente',
            showConfirmButton: false,
            timer: 1500
        });
    });
    window.addEventListener('preguntas', event => {
        if ($(".modal-backdrop").length) {
            $(".modal-backdrop")[0].remove();
        }
        $('#exampleModal').modal('hide');
        $('#offcanvasExample').offcanvas('hide');
        Swal.fire({
            icon: 'success',
            title: 'La pregunta fue ' + event.detail +  ' exitosamente',
            showConfirmButton: false,
            timer: 1500
        });
    });
    
    window.addEventListener('terminar_encuesta', event => {
        Swal.fire({
            icon: 'info',
            title: 'Usted ya lleno esta encuesta gracias por su ayuda',
            showConfirmButton: false,
            timer: 1500
        });
    });

    window.addEventListener('eliminar', event => {
        Swal.fire({
            icon: 'success',
            title: 'La '+ event.detail +' fue elimninada exitosamente',
            showConfirmButton: false,
            timer: 1500
        });
    });

    window.addEventListener('restaurar', event => {
        Swal.fire({
            icon: 'success',
            title: 'La '+ event.detail +' fue restaurada exitosamente',
            showConfirmButton: false,
            timer: 1500
        });
    });

    window.addEventListener('popoverremove', event => {
        popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
        });
    });
    window.addEventListener('hidden.bs.modal', function (event) {
        $(document.body).attr('style', '');
    });

    var pregunta_id = -1;
    var recognition = new webkitSpeechRecognition();
    var boton = 1;
    recognition.continuous = true;
    recognition.lang = "es";
    recognition.interimResults = false;
 
    window.addEventListener('voz', function (event) {
        recognition.start();
    });

    window.addEventListener('voz_disabled', function (event) {
        recognition.stop();
    });

    window.addEventListener('finalizar_encuesta', function (event) {
        Swal.fire({
        icon: 'success',
        title: 'La encuesta termino exitosamente',
        showConfirmButton: false,
        timer: 1500
        });
    });

    window.addEventListener('eliminar_encuestados', function (event) {
        Swal.fire({
            title: 'Segur@ que quieres eliminar las encuestas hechas?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
            denyButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.Livewire.emit('confirmar_eliminacion');
                } else if (result.isDenied) {
                }
            })
    });

    recognition.onresult = function (event) {
        finalResult = '';
        for (var i = event.resultIndex; i < event.results.length; ++i) {
            if (event.results[i].isFinal) {
                finalResult = event.results[i][0].transcript;
                if (pregunta_id != -1) {
                    $(boton).removeClass("btn-danger").addClass("btn-dark");
                    $("#textarea"+pregunta_id).val(finalResult);
                    $("#textarea"+pregunta_id).focus();
                } else {
                    window.Livewire.emit('quitar_vox', finalResult);
                }
                recognition.stop();
            }
        }
    };
    $(".speech").click(function() {
        pregunta_id = parseInt($(this).attr('data-id'));
        $(this).removeClass("btn-dark").addClass("btn-danger");
        boton = this;
        recognition.start();
    });

    $('#downloadPdf').click(function(event) {
        var cantidad = parseInt(document.getElementById("cantidad_reportes").value);
        var cantidad_preguntas = parseInt(document.getElementById("cantidad_preguntas").value);
        var cantidad_encuestado = parseInt(document.getElementById("encuestados").value);
        var nombre = document.getElementById("nombre_encuesta").value;
        if (document.getElementById("reporte_0")) {
            var inicio = 0;
            var doc = new jspdf.jsPDF({format: 'letter'});
            doc.setFontSize(12);
            doc.setFont('Comic Sans');
            doc.setTextColor(123, 128, 154);
            if (cantidad > 0) {
                llenarEncuestasPDF(inicio, cantidad, doc, cantidad_preguntas, nombre);
            }
        } else {
            if (cantidad_encuestado > 0) {
                Swal.fire({
                icon: 'info',
                title: 'Seleccione vista PDF para poder usar esta funcionalidad',
                showConfirmButton: true
                });
            } else {
                Swal.fire({
                icon: 'info',
                title: 'No hay encuestas echas porfavor realice encuestas para poder usar esta funcionalidad',
                showConfirmButton: true
                });
            }
        }
    });
    function llenarEncuestasPDF(inicio, cantidad, objeto, cantidad_preguntas, nombre) {
        var control_inicio = inicio;
        try {
            if (inicio < cantidad) {
                html2canvas(document.getElementById("reporte_" + inicio)).then(function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    if (cantidad_preguntas >= 2 || cantidad_preguntas == 2) {
                        objeto.addImage(img,'PNG',8 ,0 , 200, 285);
                    } else {
                        objeto.addImage(img,'PNG',8 ,0 , 200, 130);
                    }
                    objeto.text(8, 55, "Daniela Miranda Rocha", null, 90);
                    objeto.text(205, 210, "Instituto Tecnologico INFOCAL", null, -90);
                    if ((control_inicio + 1) < cantidad) {
                        objeto.addPage("letter");
                    }
                    llenarEncuestasPDF(inicio + 1, cantidad, objeto, cantidad_preguntas -3, nombre)
                });
            } else {
                objeto.save(nombre+'_estadisticaPDF.pdf');
            }
        } catch(e) {
        }
    }
}); 

</script>
</body>
</html>
