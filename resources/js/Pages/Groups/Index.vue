// <template>
    <app-layout>

        <!-- <template #header>
            <h3 class="text-gray-700 text-3xl font-medium">Groups</h3>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Módulo de Grupos
            </h2>
        </template> -->

        <div class="py-12">

            <inertia-link :href="route('groups.create')" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                Crear
            </inertia-link>
                            
            <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-800 text-gray-200">
            <tr class="text-left border-b border-gray-300">
                <th class="px-4 py-3">Id</th>
                <th class="px-4 py-3">Key</th>
                <th class="px-4 py-3">Dependiente</th>
                <th class="px-4 py-3">Acciones</th>
            </tr>
            <tr v-for="group in groups" :key="group.id" class="bg-gray-700 border-b border-gray-600">
                <td class="px-4 py-3">
                    <span v-text="group.id"></span>
                </td>
                <td class="px-4 py-3">
                    <span v-text="group.key"></span>
                </td>
                <td class="px-4 py-3">
                    <span v-if="group.group_dependent_id == null">Ninguno</span>
                    <span v-else v-text="group.group_dependent_id"></span>                    
                </td>
            </tr>                
            </table>

            <pre>
                {{groups}}
            </pre>
    
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
        data() {
            return {
                // q: ''
            }
        },
        // watch: {
        //     q: function (value) {
        //         this.$inertia.replace(this.route('notes.index', {q: value}))
        //     }
        // }
    }
</script>
