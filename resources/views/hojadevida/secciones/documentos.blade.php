<hr width="100%" style="border-top:2px solid #e0e0e0;" > 
<div class="col-12" id="documentos" name="documentos">
                <label for="titulo" class="pt-3 pb-3">
                <h4><strong class="text-uppercase "> Documentos </strong></h4>
                </label>
                @if($persona->perfil()->exists())
                <div class="form-row">
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="acta_nacimiento">Acta de nacimiento:</label>
                        </div>
                        <div class="col-md-3">
                            @isset($persona->perfil->acta_de_nacimiento)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                          
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="solicitud_empleo">Solicitud empleo:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->solicitud_empleo)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="no_habilitacion">No habilitacion:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->no_habilitacion)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="numero_seguro">Numero seguro:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->numero_seguro)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                 
                    
            </div>

            <div class="form-row">
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="rfc">RFC:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->rfc)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="curp">CURP:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->curp)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="certificado_secundaria">Certificado secundaria:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->cer_secundaria)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="certificado_bachillerato">Certificado bachillerato:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->cer_bachillerato)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                 
                    
            </div>
            <div class="form-row">
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="certificado_tecnico">Certificado tecnico:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->cer_tecnico)
                            <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                            <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="certificado_profesional">Certificado profesional:  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->cer_profesional)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class="col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="foto_perfil">Foto perfil  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->foto_perfil)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>
                    <div class=" col-md-3 pb-4">
                    <div class="row">
                        <div class="col-md-9">
                            <label for="huellas">Huellas  </label>
                              </div>
                             <div class="col-md-3">
                            @isset($persona->perfil->huellas)
                           <i class="fa fa-check-circle fa-2x text-success" aria-hidden="true"></i>
                            @else
                           <i class="fa fa-times-circle fa-2x text-danger" aria-hidden="true"></i>
                            @endisset
                            </div>
                            </div>
                    </div>                                  
                    
            </div>
          @else 
                    <br>
                <label for="informe" class="pt-3 pb-3">
                <em>No existe ningun registro</em> 
                </label>
                
            @endif  
        </div>