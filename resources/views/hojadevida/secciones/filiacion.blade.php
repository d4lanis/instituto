<hr width="100%" style="border-top:2px solid #e0e0e0;" >
<div class="col-12" id="media_filiacion" name="media_filiacion">

        <label for="titulo" class="pt-3 pb-3">
        <h4><strong class="text-uppercase ">Media filiacion</strong></h4>
            
        </label>
        @if($persona->filiacion()->exists())
    <div class="form-row">

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="complexion_id">Complexion</label>
		            <input readonly name="complexion_id" value="{{$persona->filiacion->complexion->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="color_piel_id">Color de piel</label>
                    <input readonly name="color_piel_id" value="{{$persona->filiacion->color_piel->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="cantidad_de_cabello_id">Cantidad de cabello</label>
                    <input readonly name="cantidad_de_cabello_id" value="{{$persona->filiacion->cantidad_cabello->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="color_de_cabello_id">Color de cabello</label>
                    <input readonly name="color_de_cabello_id" value="{{$persona->filiacion->color_cabello->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="forma_de_cabello_id">Forma de cabello</label>
                    <input readonly name="forma_de_cabello_id" value="{{$persona->filiacion->forma_cabello->name}}"
                            disable class="form-control {{$input_color}} ">
            </div>

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="color_de_ojos_id">Color de ojos</label>
                    <input readonly name="color_de_ojos_id" value="{{$persona->filiacion->color_ojos->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 
       
            
            </div>

    <div class="form-row">
            <div class="md-form col-md-2">
                    <label class="active pl-3" for="size_de_ojos_id">Tamaño de ojos</label>
		            <input readonly name="size_de_ojos_id" value="{{$persona->filiacion->size_ojos->name}}"
                            disable class="form-control {{$input_color}} ">
            </div>

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="size_de_nariz_id">Tamaño de nariz</label>
                    <input readonly name="size_de_nariz_id" value="{{$persona->filiacion->size_nariz->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="size_de_boca_id">Tamaño de boca</label>
                        <input readonly name="size_de_boca_id" value="{{$persona->filiacion->size_boca->name}}"
                            disable class="form-control {{$input_color}} ">
            </div> 

            <div class="md-form col-md-2">
                    <label class="active pl-3" for="forma_de_cara_id">Forma de cara</label>
                        <input readonly name="forma_de_cara_id" value="{{$persona->filiacion->forma_cara->name}}"
                                disable class="form-control {{$input_color}} ">
            </div> 
    </div>
    @else 
                    <br>
                <label for="informe" class="pt-3 pb-3">
                    <em>No existe ningun registro</em> 
                </label>
                
            @endif  
</div>