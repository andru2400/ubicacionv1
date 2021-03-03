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
                                 <input type="text" class="form-input w-full rounded-md shadow-sm" name="first_name" id="first_name" v-model="form.key">                                
                                <label class="block font-medium text-sm text-gray-700 p-2">
                                    DEPENDIENTE
                                </label>
                                <select class="w-full border bg-white rounded px-3 py-2 outline-none" v-model="form.group_dependent_id">
                                    <option class="py-1">Option 1</option>
                                    <option class="py-1">Option 2</option>
                                    <option class="py-1">Option 3</option>
                                </select>                                
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md my-4">
                                    Crear
                                </button>
                            </form>
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
        data () {
            return {
                form: {
                    key: this.group.key,
                    group_dependent_id:  this.group.group_dependent_id,
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(this.route('groups.update',this.group.id), this.form)
            }
        }
    }
</script>
