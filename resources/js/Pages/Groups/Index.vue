// <template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Módulo de Grupos
            </h2>
        </template>

        <div class="py-12">
            Hola
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
