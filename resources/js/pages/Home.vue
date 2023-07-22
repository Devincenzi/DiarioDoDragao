<template>
<div class="fixed bottom-0 top-12 left-0 right-0">
    <div class='relative w-full flex bg-zinc-800 border-y border-zinc-700 pt-1'>
        <div class='bg-zinc-700 py-1 px-4 hover:bg-zinc-600 cursor-pointer font-semibold text-lg border-x border-t rounded-t-md border-zinc-800'>Capítulo 1</div>
        <div class='bg-zinc-700 py-1 px-4 hover:bg-zinc-600 cursor-pointer font-semibold text-lg border-x border-t rounded-t-md border-zinc-800'>Capítulo 2</div>
    </div>
    <div class="relative grid grid-cols-9 h-full">
        <div class="col-span-1 h-full flex flex-col border-r border-zinc-900 overflow-x-clip">
            <div class="bg-neutral-900 font-semibold p-1 flex justify-between">
                <span>Locais</span>
                <button @click="FormPlannerObject.mostrar = true" class="bg-amber-500 px-1 uppercase font-bold">+</button>
            </div>

            <form-planner-object v-if="FormPlannerObject.mostrar" :texto="FormPlannerObject.texto" :id="FormPlannerObject.id"
                @close-form="FormPlannerObject.mostrar = false"
                @form-submit-sucesso="novaLocalizacao"
                @form-submit-falha="teste"
                actionURL="api/localizacoes"></form-planner-object>

            <planner-object v-for="localizacao in currentLocalizacoes" :key="localizacao.id" 
                :texto="localizacao.nome" :id="localizacao.id" @abrir-menu-objeto="handleMenuObjeto"></planner-object>
        </div>
        <div class="col-span-1 h-full flex flex-col border-r border-neutral-900">
            <div class="bg-neutral-900 font-semibold p-1">Organizações</div>
        </div>
        <div class="col-span-1 h-full flex flex-col border-r border-neutral-900">
            <div class="bg-neutral-900 font-semibold p-1">Criaturas</div>
        </div>
        <div class="col-span-1 h-full flex flex-col border-r border-neutral-900">
            <div class="bg-neutral-900 font-semibold p-1">Missões</div>
        </div>
        <div class="col-span-1 h-full flex flex-col border-r border-neutral-900">
            <div class="bg-neutral-900 font-semibold p-1">Coisas</div>
        </div>
        <div class="col-span-4 h-full">
            <div class='bg-neutral-900 font-semibold p-1'>Cormyr</div>
            <div class="p-2 h-full">
                <div class="bg-gradient-to-br from-slate-100 to-slate-200 h-3/4 border-y-4 border-orange-700 text-zinc-800 p-2"> Uma terra bonita.</div>
            </div>
        </div>

        <div v-if="parametrosMenuObjeto.mostrar" :style="{left: parametrosMenuObjeto.fromLeft, top: parametrosMenuObjeto.fromTop}" 
            class="absolute border border-neutral-700 bg-neutral-900 text-sm">
            <div class="hover:bg-neutral-800 px-1 cursor-pointer" @click="handleRenomearObjeto">Renomear</div>
        </div>
    </div>
</div>
</template>

<script>
export default{
    props: ['listalocalizacoes'],
    data(){
        return{
            FormPlannerObject: {
                id: '',
                texto: '',
                mostrar: false,
            },
            currentLocalizacoes: this.listalocalizacoes,
            parametrosMenuObjeto: {
                mostrar: false,
                fromLeft: '',
                fromTop: '',
                id: '',
                texto: ''
            },
        }
    },
    methods: {
        novaLocalizacao(localizacao){
            this.currentLocalizacoes.push(localizacao);
        },
        teste(resposta){
            console.log(resposta);
        },
        handleMenuObjeto(parametros){
            window.addEventListener('click', (e) => this.handleMouseDown(parametros.elemento, e.target));

            const newFromLeft = parametros.elemento.offsetWidth - 5;
            const newFromTop = parametros.elemento.offsetTop - 5;

            this.parametrosMenuObjeto.fromLeft = newFromLeft+'px';
            this.parametrosMenuObjeto.fromTop = newFromTop+'px';
            this.parametrosMenuObjeto.mostrar = true;

            this.parametrosMenuObjeto.id = parametros.id;
            this.parametrosMenuObjeto.texto = parametros.texto;
        },
        handleRenomearObjeto(){
            this.parametrosMenuObjeto.mostrar = false;

            this.FormPlannerObject.id = this.parametrosMenuObjeto.id;
            this.FormPlannerObject.texto = this.parametrosMenuObjeto.texto;
            this.FormPlannerObject.mostrar = true;
        },
        handleMouseDown(elementoAlvo, eventoAlvo){
            if(elementoAlvo != eventoAlvo){
                this.parametrosMenuObjeto.mostrar = false;

                window.removeEventListener('click', (e) => this.handleMouseDown);
            }
        }
    },
}
</script>