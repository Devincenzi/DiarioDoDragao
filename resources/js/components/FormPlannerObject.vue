<template>
<div class="fixed top-0 bottom-0 left-0 right-0 backdrop-blur-sm bg-slate-900 bg-opacity-30 z-50 flex justify-center items-center">
    <div class="bg-neutral-900 w-1/4 rounded-lg">
        <form @submit="sendForm">
            <input type="hidden" name="id" :value="id"/>
            <div class="px-4 my-4 grid grid-cols-5">
                <label class="text-sm p-1 col-span-1">Nome</label>
                <input class="rounded-lg text-sm text-neutral-900 py-1 col-span-5" name="nome" type="text" v-model="nomeNovoObjeto"/>
            </div>
            <!-- <div class="px-4 mb-2 grid grid-cols-5">
                <label class="text-sm p-1 rounded-lg col-span-1">Descrição</label>
                <textarea class="rounded-lg text-sm text-neutral-900 py-1 col-span-5" name="descricao" type="text" v-model="nomeNovaLocalizacao"></textarea>
            </div> -->
            <div class="bg-zinc-700 border-t rounded-b-lg border-neutral-700 w-full flex justify-around items-center py-2">
                <button class="bg-gray-500 py-1 px-2 rounded-md" type="reset" @click="this.$emit('close-form')">cancelar</button>
                <button class="bg-sky-800 py-1 px-2 rounded-md" type="submit">confirmar</button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
export default{
    props: ['actionURL', 'titulo', 'texto', 'id'],
    data(){
        return{
            showForm: false,
            nomeNovoObjeto: this.texto
        }
    },
    methods:{
        async sendForm(e){
            e.preventDefault();

            const options = {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({'nome':this.nomeNovoObjeto})
            }
            // console.log(options.body);
            const response = await fetch(this.actionURL, options);

            if(response.status == 200){
                const novoObjeto = await response.json();
                this.$emit('form-submit-sucesso', novoObjeto);
            }
            if(response.status == 500){
                const novoObjeto = await response.json();
                this.$emit('form-submit-falha', novoObjeto);
            }
        }
    }
}
</script>