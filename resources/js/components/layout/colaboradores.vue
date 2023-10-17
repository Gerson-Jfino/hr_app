<template>

        <v-main class="grey lighten-3">
            <v-container>
                <v-row>
                    <v-col cols="12">
                        <!-- <v-sheet rounded="lg"> -->
                            <v-card height="55px" style="background-color: rgba(128, 128, 128, 0.356);">
                                <v-card-text>

                                    <v-row>
                                        <v-col cols="3" style="margin-top: -10px;">
                                            <v-text-field
                                            v-model.lazy.trim="data.name"
                                            height="40px"
                                            append-icon="mdi-account-search"
                                            label="Pesquisar"
                                            placeholder="Pesquisar colaborador"
                                            dense
                                            solo
                                            @click:append.prevent="search"
			                                @keypress.enter.prevent="search">
                                            </v-text-field>
                                        </v-col>
                                        
                                        <v-col cols="7">

                                            <v-row>
                                                <v-col cols="1" style="margin-right: -15px;">
                                                    Filtros:
                                                </v-col>
                                                <v-col cols="3" style="margin-top: -10px;">
                                                    <v-select v-model="situation_id" :items="data.situation" item-text="name"  item-value="id" @change="filterSituation(situation_id)" label="Situação" dense solo></v-select>
                                                </v-col>
                                                <v-col cols="3" style="margin-top: -10px;">
                                                    <v-select v-model="pelouro_id" :items="data.pelouros" item-text="name" item-value="id" @change="filterPelouro(pelouro_id)" label="Pelouro" dense solo></v-select>
                                                </v-col>
                                                <v-col cols="4" style="margin-top: -10px;">
                                                    <v-select v-model="uni_org" :items="data.uni_org" item-text="name" item-value="id" label="Direção" @change="filterUni(uni_org)" dense solo></v-select>
                                                </v-col>
                                                <v-col cols="1" style="margin-top: -10px;">
                                                        <v-btn
                                                        class="mx-2"
                                                        fab
                                                        small
                                                        @click="clearFilter"
                                                        >
                                                        <v-icon large>
                                                            mdi-close-circle
                                                        </v-icon>
                                                    </v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                    </v-row>

                                </v-card-text>
                            </v-card>
                        <!-- </v-sheet> -->
                    </v-col>
                </v-row>
                <v-row align="center">
                    <v-col cols="12">
                        <v-sheet rounded="lg">
                            <v-card>
                                <v-card-title>
                                    <v-row>
                                        <v-col cols="2">
                                            <v-btn
                                            color="#ff9900"
                                            dark
                                            class="mb-2"
                                            :to="{name: 'colaborador.create'}"
                                            >
                                            Adicionar Colaborador
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-card-title>
                                <v-card-text>
                                    <v-simple-table
                                        fixed-header
                                        height="500px"
                                    >
                                        <!-- <template v-slot:default> -->
                                            <thead>
                                                <tr>
                                                    <th class="text-left">Colaborador</th>
                                                    <th class="text-left">Situação</th>
                                                    <th class="text-left">Unidade Organica</th>
                                                    <th class="text-left">Pelouro</th>
                                                    <th class="text-left">Sector</th>
                                                    <th class="text-left">Categoria</th>
                                                    <th class="text-right">Acções</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr
                                            v-for="col in colaboradores.data"
                                            :key="col.nome_completo"
                                            >
                                                <td>{{ col.nome_completo }}</td>
                                                <td>{{ col.situation?.name }}</td>
                                                <td>{{ col.uni_org?.name }}</td>
                                                <td>{{ col.pelouro?.name }}</td>
                                                <td>{{ col.sector?.name }}</td>
                                                <td>{{ col.categoria?.name }}</td>
                                                <td class="text-right">
                                                    <v-btn depressed rounded small style="color:rgb(255, 153, 0);"  :to="{ name: 'colaborador.details', params: { id: col.id } }">Detalhes</v-btn>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!-- </template> -->
                                    </v-simple-table>
                                    <div class="text-center">
                                        <v-pagination
                                        v-model="page"
                                        :length="colaboradores.last_page"
                                        :total-visible="7"
                                        @input="handlePage"
                                        color="rgb(255, 153, 0)"
                                        prev-icon="mdi-menu-left"
                                        next-icon="mdi-menu-right"
                                        ></v-pagination>
                                    </div>
                                </v-card-text>
                            </v-card>

                        </v-sheet>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>

</template>
<script>
import Axios from 'axios';
import { BASE_URL } from '../../config/api'
  export default {
    data () {
      return {
        colaboradores: [],
        uni_org: null,
        situation_id: null,
        pelouro_id: null,
        data: {
            name: '',
            pelouros: [],
            uni_org: [],
            situation: [],
        },
        page: 1,
      }
    },
    created() {
        this.getColaboradores()
        this.getFilters()
    },
    methods: {
        async getColaboradores() {
            this.$store.state.Loader.loading = true
            // console.log();
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores`)).data
            this.$store.state.Loader.loading = false

        },
        async handlePage(page) {
            this.$store.state.Loader.loading = true
            this.page = page
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores?page=${page}`)).data
            this.$store.state.Loader.loading = false

        },
        async getFilters() {
            this.$store.state.Loader.loading = true
            const companyData = await Axios.get(`${BASE_URL}pelouros`)
            this.data.pelouros = companyData.data.pelouros;
            this.data.uni_org = companyData.data.uni_org;
            this.data.situation = companyData.data.situation;
            this.$store.state.Loader.loading = false
        },
        async filterUni(uni_ord) {
            this.$store.state.Loader.loading = true
            // console.log();
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores?uni_org=${uni_ord}`)).data
            this.$store.state.Loader.loading = false
        },
        async filterSituation(stituation) {
            this.$store.state.Loader.loading = true
            // console.log();
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores?situacao=${stituation}`)).data
            this.$store.state.Loader.loading = false
        },
        async filterPelouro(pelouro) {
            this.$store.state.Loader.loading = true
            // console.log();
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores?pelouro=${pelouro}`)).data
            this.$store.state.Loader.loading = false
        },
        clearFilter() {
            this.data.name = ""
            this.data.pelouros = []
            this.data.uni_org = []
            this.data.situation =[]
            this.getColaboradores()
        },
        async search() {
            this.$store.state.Loader.loading = true
            // console.log();
            this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores?nome=${this.data.name}`)).data
            this.$store.state.Loader.loading = false
        }
    }
  }
</script>
<style>

.headcolor {
    background-color: aquamarine;
}
th {
    text-align: left;
}
</style>
