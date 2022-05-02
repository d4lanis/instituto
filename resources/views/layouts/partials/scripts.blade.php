<script>
    // SideNav init
    $(".button-collapse").sideNav();
    
    // var el = document.querySelector('.custom-scrollbar');
    // Ps.initialize(el);

    $('.datepicker').pickadate({
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        today: 'Hoy',
        clear: 'Cancelar',
        close: 'Cerrar',
        format: 'dd/mm/yyyy',
        formatSubmit: 'yyyy/mm/dd',
        firstDay: 1
    });

    // Material Select Initialization
    $(document).ready(function () {
        $('.mdb-select').material_select();
    
        $('[data-toggle="tooltip"]').tooltip();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    var lang = 
        {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Registros _START_ - _END_ de _TOTAL_ registros",
            "sInfoEmpty":      "Sin registros",
            "sInfoFiltered":   " filtrados de un Total _MAX_)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

    $(document).ready(function () {
        $.extend( true, $.fn.dataTable.defaults, {
            info: true,
            language : lang,
            paging: true,
            searching: true,
            ordering: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ]
        } );

        $.fn.dataTable.ext.errMode = 'none';
    });

    function dynamicDropdown(url, id = null, target, otro = null) {

        let data = {
            id: id
        }

        $.post(url, data, function(result){
            let default_value = 0;
            let $select = $("#"+target);
            $select.material_select('destroy');
            $select.empty();
            let options = [];

            if(null == data.id){
                options.push(`<option value="" selected>`+target+
                    ` - seleccione una opción</option</option>`);
            } else {
                options.push(`<option value=""> -------------- </option</option>`);
                default_value = data.id;
            }

            if(result.status === 'ok'){
                $.each(result.data, function(i, item) {
                    item_name = item.name.toUpperCase();
                    if(item.id == default_value){
                        options.push(`<option value="${item.id}" selected>${item_name}</option>`);
                    } else {
                        options.push(`<option value="${item.id}">${item_name}</option>`);
                    }

                });
                if (null != otro) {
                     options.push(`<option value="1">`+otro+`</option>`);
                }
            }
            
            $select.append(options);
            $select.material_select();

        }).fail(function(){
            $('#getDiv').html('algo salio mal');
        });
    }

    function clearDropdown(select)
    {
        select.material_select('destroy');
        select.empty();
        let options = [];
        options.push(`<option value="" disabled selected> Cargando datos </option>`);
        select.append(options);
        select.material_select();
    }

    function dynamicCheckboxes(url, id = null, container, type = null, style = null, otro = null){

        let data = {
            id: id,
        }
        // console.log('<data.id>');
        // console.log(data.id);
        // console.log('</data.id>');

        $.post(url, data, function(result){
            let $div = $("#"+container);
            $div.empty();

            if(result.status === 'ok'){
                var checked_ids = [];
                if (typeof data.id === 'string' & data.id.length > 0) checked_ids = data.id.split(',');
                
                // console.log('<checked_ids>');
                // console.log(checked_ids);
                // console.log('</checked_ids>');
                
                let j = 0; 

                $.each(result.data, function(i, item) {
                    let checked = checked_ids.includes(item.id.toString());
                    let $checkbox_item = addCheckboxes(container, i, item, type, style, checked);
                    // console.log('>>>>' + item.id.toString() + '<<<<')
                    // console.log('>>>>' + checked_ids.includes(item.id.toString()) + '<<<<')
                    $div.append($checkbox_item);
                    j++;
                });
                if (null != otro) {
                    element = "#show_modal_SelectOther_" + container;
                    item = {
                        id:1, 
                        name: otro, 
                        event:`onchange="show_popup_for_others('`+element+`');return false;"` 
                    };
                    $div.append(addCheckboxes(container, j++, item, type));
                }
            }
            

        }).fail(function(){
            $('#getDiv').html('algo salio mal');
        });
    }

    function addCheckboxes(container, i, item, type='checkbox', style=null, checked_item) {
        let field_name = container;
        let checked = '';
        if (type == 'checkbox') field_name += "[]";
        if (null==item.event) item.event = '';
        if (null==style) style = '';        
        if (checked_item == true) checked = 'checked="checked"';

        return `<div class="p-2 ${style}">
            <input class="form-check-input ${item.categoria_puestos_id}" type="${type}" 
            value="${item.id}" id="${container}_${i}" ${checked} 
            name="${field_name}" aria-expanded="false" ${item.event} > 

            <label class="form-check-label" for="${container}_${i}">
                ${item.name}
            </label>
        </div>`;
    }

    $("#modal-update-password-btn").click(function() {
            $.ajax({
                type: 'post',
                url: '/update_password',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'item_id': $('input[name=password]').attr('item_id'),
                    'password': $('input[name=password]').val(),
                    'new_password': $('input[name=new_password]').val(),
                    'new_password_confirmation': $('input[name=new_password_confirmation]').val()
                },
                success: function(data) {
                    var box_message = $('#change_password_modal').find('p.msg');

                    box_message.removeClass('hidden');
                    box_message.removeClass('alert-danger');
                    box_message.removeClass('alert-success');
                    if ((data.errors)) {
                        box_message.text(JSON.stringify(data.errors, null, '\t'));
                        box_message.addClass('alert-danger');
                    } else {
                        box_message.text(JSON.stringify(data.info, null, '\t'));
                        box_message.addClass('alert-success');
                    }
                },
                error: function(data) {
                    alert("error");
                },
            });
    });

    //se reinicia el modal para que este listo para la siguiente acción
    $("#close_change_password_modal").click(function() {

        var box_message = $('#change_password_modal').find('p.msg');
        box_message.addClass('hidden');
        box_message.text('');
        box_message.removeClass('alert-danger');
        box_message.removeClass('alert-success');
        $("div[id=current_password]").
            find("input[name=password]").attr("item_id",0);
        $("div[id=current_password]").show(); 

        $('input[name=password]').val('');
        $('input[name=new_password]').val('');
        $('input[name=new_password_confirmation]').val('');
    });

    function getPosition(poblacion_id) {
        $.ajax({
            type: 'post',
            url: "/getPoblacionPosition",
            data: {
                '_token': $('input[name=_token]').val(),
                'poblacion_id': poblacion_id
            },
            success: function(data) {
                return data.position;
            },
            error: function(data) {
                alert("error");
            },
        });
    }

    function guardar_expediente(url, data){
        console.log(data);
        $.post(url, data, function(results){
            return results.status;
        });
    }
    
    var isSafari = /^((?!chrome|android|crios|fxios).)*safari/i.test(navigator.userAgent);
</script>

@yield('custom_scripts')

@stack('scripts2')



<script>
    new WOW().init();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.stepper').mdbStepper();
    });
</script>


