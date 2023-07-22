<template>
    <div @click.right="handleAbrirMenu" class="w-full">
        <div ref='texto' class="bg-zinc-800 border-l-4 ml-2 border-b text-sm px-2 py-1 w-full border-neutral-600">
            <div class="absolute left-0 p-0.5 w-fit bg-neutral-600 border border-neutral-700 rounded-full hover:bg-neutral-700 cursor-pointer" @click="collapse()"><img src="/icons/angle-arrow-down.png" class="w-3"/></div>
            <span class="first-letter:uppercase">{{ texto }}</span>
        </div>
    </div>
</template>

<script>

export default{
    props: ['texto', 'id'],
    data(){
        return{
            closed: false,
        }
    },
    methods: {
        collapse(){
            this.closed = !this.closed;
        },
        handleAbrirMenu(evento){
            evento.preventDefault();
            // console.log(this.$.vnode.el);
            // const fromTop = this.$.vnode.el.offsetTop;
            // const fromLeft = this.$.vnode.el.offsetWidth;

            const parametros = {id: this.id, 'elemento': this.$.vnode.el, 'texto':this.texto};

            this.$emit('abrir-menu-objeto', parametros);
        }
        // async lookupForLocalizacoes(){
        //     const url = `api/localizacoes/${this.id}`;
        //     const response = await fetch(url);
        //     const result = await response.json();

        //     this.listaLocalizacoes = result;
        // },
    },
}
</script>