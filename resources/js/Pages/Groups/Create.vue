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
                                    DEPENDIENTE
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
                                {{groups}}
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
                                    </tr>                                    
                                    <tr v-for="parameter in form.parameters" :key="parameter" class="bg-gray-100 border-b border-gray-200">
                                        <td class="px-4 py-3" v-text="parameter.value"></td>
                                        <td class="px-4 py-3" v-text="parameter.parameter_dependent_id"></td>                                        
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
            }
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('groups.store'), this.form)
            },
            addItem(){
                const search = this.form.parameters.find((item) => item.value === this.tempValue)
                if(search){
                    return;
                }else{                    
                    console.log(search);
                    var arrayTemp = {
                                        "value": this.tempValue,
                                        "parameter_dependent_id": this.tempDependent,
                                    };
                    this.form.parameters.push(arrayTemp);                
                }
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
