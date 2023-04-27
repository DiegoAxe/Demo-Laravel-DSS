<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Editoriales</title>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <style>
        *{
            text-align: center;
        }
        #app{
            background-color:#CFD8DC;
        }
        .btn-lg{
            margin: 30px 0;
        }
        
    </style>
</head>
<body>
<div id="app">
    <v-app>
        <v-main>

            <!-- Botón CREAR (Método HTTP: POST) -->
            <v-flex class="text-center align-center">
                <button type="button" class="btn btn-success btn-lg" @click="formNuevo()">Crear nueva editorial</button>
            </v-flex>

            <v-card class="mx-auto mt-5" color="transparent" max-width="1280" elevation="8">

                <!-- Tabla y formulario -->
                <v-simple-table class="mt-5">
                    <template v-slot:default>
                        <thead>
                        <tr class="darken-4" style="background-color: #00008B">
                            <th class="white--text text-center" >CÓDIGO</th>
                            <th class="white--text text-center" >NOMBRE</th>
                            <th class="white--text text-center" >TELEFONO</th>
                            <th class="white--text text-center" >CONTACTO</th>
                            <th class="white--text text-center">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="editorial in editorials" :key="editorial.codigo_editorial">
                            <td>{{ editorial.codigo_editorial }}</td>
                            <td>{{ editorial.nombre_editorial }}</td>
                            <td>{{ editorial.contacto }}</td>
                            <td>{{ editorial.telefono }}</td>
                            <td>
                                <!-- Boton que ejecuta el proceso de GET unico -->
                                <button type="button" @click="ver(editorial.codigo_editorial)" class="btn btn-primary btn-sm">Detalles (GET)</button>
                                <!-- Boton que ejecuta el proceso de PUT unico -->
                                <button type="button" @click="formEditar(editorial.codigo_editorial, editorial.nombre_editorial,
                                    editorial.contacto, editorial.telefono)" class="btn btn-warning btn-sm">Editar (PUT)</button>
                                <!-- Boton que ejecuta el proceso de DELETE unico -->
                                <button type="button" @click="borrar(editorial.codigo_editorial)" class="btn btn-danger btn-sm">Eliminar (DELETE)</button>
                                </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-card>
            <!-- Componente de Diálogo para CREAR y EDITAR -->
            <v-dialog v-model="dialog" max-width="500">
                <v-card>
                    <v-card-title class="blue darken-2 white--text">Editorial</v-card-title>
                    <v-card-text>
                        <v-form>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.codigo_editorial" label="Codigo" solo required>{{editorial.codigo_editorial}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.nombre_editorial" label="Nombre" solo required>{{editorial.nombre_editorial}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.contacto" label="Contacto" solo required>{{editorial.contacto}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.telefono" label="Telefono" solo required>{{editorial.telefono}}</v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="dialog=false" color="blue-grey" dark>Cancelar</v-btn>
                        <v-btn @click="guardar()" type="submit" color="blue darken-2" dark>Guardar</v-btn>
                    </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>

            <!--Ver un registro especificamente-->
            <v-dialog v-model="dialog2" max-width="500">
                <v-card>
                    <v-card-title class="blue darken-2 white--text">Editorial</v-card-title>
                    <v-card-text>
                        <v-form>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.codigo_editorial" label="Nombre" solo required>{{editorial.codigo_editorial}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.nombre_editorial" label="Nombre" solo required>{{editorial.nombre_editorial}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.contacto" label="Contacto" solo required>{{editorial.contacto}}</v-text-field>
                                    </v-col>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="editorial.telefono" label="Telefono" solo required>{{editorial.telefono}}</v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="dialog2=false" color="blue-grey" dark>Cerrar</v-btn>
                    </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>
        </v-main>
    </v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/2.5.7/vuetify.min.js" integrity="sha512-BPXn+V2iK/Zu6fOm3WiAdC1pv9uneSxCCFsJHg8Cs3PEq6BGRpWgXL+EkVylCnl8FpJNNNqvY+yTMQRi4JIfZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    let url = 'http://localhost:8000/api/editoriales/';

    new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data() {
            return {
                editorials: [],
                dialog: false,
                dialog2: false,
                operacion: '',
                editorial:{
                    codigo_editorial: null,
                    nombre_editorial:'',
                    contacto:'',
                    telefono:''
                }
            }
        },
        created(){
            this.mostrar()
        },
        methods:{
            //MÉTODOS PARA EL CRUD
            mostrar:function(){
                axios.get(url)
                    .then(response =>{
                        this.editorials = response.data;
                    })
            },
            mostrarUno:function(id){
                axios.get(url+id)
                    .then(response =>{
                        this.editorial.nombre_editorial = response.data.nombre_editorial;
                        this.editorial.contacto =  response.data.contacto;
                        this.editorial.telefono =  response.data.telefono;
                        this.editorial.codigo_editorial =  response.data.codigo_editorial;
                        this.dialog2=true;
                    })
            },
            crear:function(){
                let parametros = {nombre_editorial:this.editorial.nombre_editorial, contacto:this.editorial.contacto,
                    telefono:this.editorial.telefono, codigo_editorial:this.editorial.codigo_editorial };
                axios.post(url, parametros)
                    .then(response =>{
                        this.mostrar();
                    });
                this.editorial.nombre_editorial="";
                this.editorial.contacto="";
                this.editorial.telefono="";
                this.editorial.codigo_editorial="";
            },
            editar: function(){
                let parametros = {nombre_editorial:this.editorial.nombre_editorial, contacto:this.editorial.contacto, telefono:this.editorial.telefono, codigo_editorial:this.editorial.codigo_editorial};
                //console.log(parametros);
                axios.put(url+this.editorial.codigo_editorial, parametros)
                    .then(response => {
                        this.mostrar();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            borrar:function(id){
                Swal.fire({
                    title: '¿Confirma eliminar el registro?',
                    confirmButtonText: `Confirmar`,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        //procedimiento borrar
                        axios.delete(url+id)
                            .then(response =>{
                                this.mostrar();
                            });
                        Swal.fire('¡Eliminado!', '', 'success')
                    } else if (result.isDenied) {
                    }
                });
            },

            //Botones y formularios
            guardar:function(){
                if(this.operacion=='crear'){
                    this.crear();
                }
                if(this.operacion=='editar'){
                    this.editar();
                }
                this.dialog=false;
                this.dialog2=false;
            },
            ver:function(id){
                this.mostrarUno(id);
            },
            formNuevo:function() {
                this.dialog=true;
                this.operacion='crear';
                this.editorial.codigo_editorial ='';
                this.editorial.nombre_editorial='';
                this.editorial.contacto='';
                this.editorial.telefono='';
            },
            formEditar:function(id, nombre, contacto, telefono){
                //capturamos los datos del registro seleccionado y los mostramos en el formulario
                this.editorial.codigo_editorial = id;
                this.editorial.nombre_editorial = nombre;
                this.editorial.contacto = contacto;
                this.editorial.telefono = telefono;
                this.dialog=true;
                this.operacion='editar';
            }
        }
    });
</script>
</body>
</html>
