<template>
    <app-layout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Módulo de Notas
            </h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">  
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px0">
                            <h3 class="text-lg text-gray-900">Crear Grupo </h3>
                            <p class="text-sm text-gray-600">Luego de crear la podrás editar</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">
                            <form @submit.prevent="submit">
                                <label class="block font-medium text-sm text-gray-700 p-2">
                                    KEY
                                </label>
                                 <input type="text" class="form-input w-full rounded-md shadow-sm" name="first_name" id="first_name" v-model="form.key" autocomplete="off" placeholder="Ingrese grupo">                                
                                <label class="block font-medium text-sm text-gray-700 p-2">
                                    DEPENDIENTE (Opcional)
                                </label>
                                <select class="w-full border bg-white rounded px-3 py-2 outline-none" v-model="form.group_dependent_id">
                                    <option class="py-1" style="color: green important!;" :value="''">Ninguno --</option>                                    
                                    <option class="py-1" v-for="group in groups" :key="group.id" :value="group.id" v-text="group.key"></option>                                    
                                </select>

                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" v-model="checkValues">
                                    <span class="ml-2 text-gray-700">¿Agregar valores a este grupo?</span>
                                </label>                                

                                <hr/>                                
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md my-4">
                                    Crear
                                </button>
                            </form>
                        </div>
                    </div>
                </div>                  
                <div class="md:grid md:grid-cols-3 md:gap-6 my-4" v-if="checkValues">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px0">
                            <h3 class="text-lg text-gray-900">Agregar valores</h3>
                            <p class="text-sm text-gray-600">Ingresa los valores ligados</p>
                        </div>
                    </div>
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-white md:rounded-md p-4">

                                <div v-if="arrayErrors.length != 0" class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p>{{ arrayErrors }}</p>
                                </div>

                                <label class="block font-medium text-sm text-gray-700 p-2">
                                    VALUE
                                </label>
                                <input type="text" class="form-input w-full rounded-md shadow-sm" name="first_name" id="first_name" v-model="tempValue" autocomplete="off" placeholder="Ingrese valor">                                
                                <div v-if="form.group_dependent_id">
                                    <label class="block font-medium text-sm text-gray-700 p-2">
                                        DEPENDIENTE DE PARAMETRO
                                    </label>
                                    <select class="w-full border bg-white rounded px-3 py-2 outline-none" v-model="tempDependent">
                                        <option class="py-1" :value="''">Ninguno --</option>                                    
                                        <option class="py-1" v-for="parameter in returnParameters" :key="parameter.id" v-text="parameter.value"></option>                                    
                                    </select>                                
                                </div>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md my-4" v-on:click="addItem">
                                    Agregar a la lista
                                </button>
                                <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
                                    <tr class="text-left border-b-2 border-gray-300">
                                        <th class="px-4 py-3">Value</th>
                                        <th class="px-4 py-3">Dependiente</th>                                                                            
                                        <th class="px-4 py-3">Acciones</th>                                                                            
                                    </tr>                                    
                                    <tr v-for="parameter in form.parameters" :key="parameter" class="bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 py-3" v-text="parameter.value"></td>
                                        <td class="px-4 py-3" v-text="parameter.parameter_dependent_id"></td>                                        
                                        <td class="px-4 py-3">
                                            <button v-on:click="delItem(parameter.value)">Eliminar</button>
                                        </td>                                        
                                    </tr> 
                                </table>                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: {
            groups: Array,
        },
        data () {
            return {
                form: {
                    key:'',
                    group_dependent_id:'',
                    parameters:[]
                },
                tempValue:'',
                tempDependent:'',
                checkValues: false,
                arrayErrors: '',
            }
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('groups.store'), this.form)
            },
            addItem(){                
                const errors = [];

                if(this.form.group_dependent_id != '' && this.tempDependent == ''){
                    errors.push('Escoge un dependiente');                    
                }

                const search = this.form.parameters.find((item) => item.value === this.tempValue)
                if(search){
                    errors.push('Valor Duplicado');                                        
                }

                if(errors.length != 0){
                    this.arrayErrors = errors.join();                    
                    return;
                }

                var arrayTemp = {
                                    "value": this.tempValue,
                                    "parameter_dependent_id": this.tempDependent,
                                };
                this.form.parameters.push(arrayTemp);                
                this.tempValue = '';
                this.tempDependent = '';
                this.arrayErrors = '';                
            },
            delItem(value){                
                const elementInArray = this.form.parameters.indexOf(value);												
				this.form.parameters.splice(elementInArray,1);	
            }
        },
        computed: {            
            returnParameters: function () {            
                const  groupTemp = this.groups.find((group) => group.id == this.form.group_dependent_id)                                
                return  groupTemp.parameters;
            }
        }
    }
</script>
