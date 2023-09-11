<template>
  <v-card>
        <!-- <v-card-title>
          <span class="text-h5">Ficha de Dados Pessoais</span>
        </v-card-title> -->
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12" md="7">
                        <v-text-field
                            label="Nome Completo"
                            outlined
                            dense
                            v-model="personalDataForm.nome_completo"
                            required
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="5">
                        <v-select
                            outlined
                            dense
                            label="Situação"
                            :items="data.situation"
                            item-text="name"
                            item-value="id"
                            v-model="personalDataForm.situation_id"
                        >
                        </v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="false"
                            :return-value.sync="date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="personalDataForm.data_situacao"
                                    label="Data da situação"
                                    append-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="personalDataForm.data_situacao"
                                dense
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu = false">
                                    Cancel
                                </v-btn>
                                <v-btn text color="primary" @click="$refs.menu.save(date)">
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-menu
                            ref="menu2"
                            v-model="menu2"
                            :close-on-content-click="false"
                            :return-value.sync="date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="personalDataForm.data_admissao"
                                    label="Data da situação"
                                    append-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="personalDataForm.data_admissao"
                                dense
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu2 = false">
                                    Cancel
                                </v-btn>
                                <v-btn text color="primary" @click="$refs.menu2.save(date)">
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-menu
                            ref="menu3"
                            v-model="menu3"
                            :close-on-content-click="false"
                            :return-value.sync="date"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    outlined
                                    dense
                                    v-model="personalDataForm.data_fim"
                                    label="Data Fim"
                                    append-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="personalDataForm.data_fim"
                                dense
                                no-title
                                scrollable
                            >
                                <v-spacer></v-spacer>
                                <v-btn text color="primary" @click="menu3 = false">
                                    Cancel
                                </v-btn>
                                <v-btn text color="primary" @click="$refs.menu3.save(date)">
                                    OK
                                </v-btn>
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-select
                            label="Categoria"
                            outlined
                            dense
                            :items="data.categoria"
                            item-text="name"
                            item-value="id"
                            v-model="personalDataForm.categoria_id">
                        </v-select>
                    </v-col>
                    <!-- <v-col cols="12" md="4">
                        <v-select
                            label="Sector"
                            outlined
                            dense>

                        </v-select>
                    </v-col> -->
                    <v-col cols="12" md="4">
                        <v-select
                            label="Nivel Academico"
                            outlined
                            dense
                            :items="data.nivel"
                            item-text="name"
                            item-value="id"
                            v-model="personalDataForm.nivel_id">
                        </v-select>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-select
                            label="Pelouro"
                            outlined
                            dense
                            :items="data.pelouros"
                            item-text="name"
                            item-value="id"
                            v-model="pelouro_id">
                        </v-select>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-select
                            label="Unidade Organica"
                            outlined
                            dense
                            :items="data.uni_org_filtered"
                            item-text="name"
                            item-value="id"
                            v-model="uni_org_id">

                        </v-select>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-select
                            label="Sector"
                            outlined
                            dense
                            :items="data.sector_filtered"
                            item-text="name"
                            item-value="id">
                        </v-select>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-text-field
                            label="Salario"
                            outlined
                            dense
                            v-model="personalDataForm.salario">
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="closeDialogCompany()"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="save"
          >
            Save
          </v-btn>
        </v-card-actions>
  </v-card>
</template>

<script>
import Axios from 'axios';
import { BASE_URL } from '../../config/api'
export default {
    data() {
        return {
            personalDataForm: {
                id: null,
                nome_completo: "",
                data_situacao: null,
                data_admissao: null,
                data_fim: null,
                nivel_id: null,
                situation_id: null,
                categoria_id: null,
                pelouro_id: null,
                uni_org_id: null,
                sector_id: null,
                salario: ""
            },
            pelouro_id: null,
            uni_org_id: null,
            sector_id: null,
            situacoes: ['Ativo', 'Reforma', 'Rescisão', 'Falecimento'],
            categorias: ['Support', 'Profissional I', 'Profissional II', 'Senior'],
            data: {
                pelouros: [],
                uni_org: [],
                uni_org_filtered: [],
                sector: [],
                sector_filtered: [],
                nivel: [],
                categoria: [],
                situation: []
            },
            menu: false,
            menu2: false,
            menu3: false,
            date: new Date().toISOString().substr(0, 10),

        }
    },
    created() {
        this.getCompanyData()
    },
    computed: {
        filteredUniOrg() {
            console.log(this.data.uni_org.filter(uni => uni.pelouro_id == personalCompanyData.pelouro_id));
            return this.data.uni_org.filter(uni => uni.pelouro_id == personalCompanyData.pelouro_id)
        }
    },
    methods: {
        closeDialogCompany() {
            this.$emit('closeCompanyDialig')
        },
        async getCompanyData() {
            this.$store.state.Loader.loading = true
            const companyData = await Axios.get(`${BASE_URL}pelouros`)
            this.data.pelouros = companyData.data.pelouros;
            this.data.uni_org = companyData.data.uni_org;
            this.data.sector = companyData.data.sector;
            this.data.nivel = companyData.data.nivel;
            this.data.categoria = companyData.data.categoria;
            this.data.situation = companyData.data.situation;
            this.$store.state.Loader.loading = false
            console.log(companyData.data);

        },
        save() {
            console.log(this.personalDataForm);
        }

    },
    watch: {
        pelouro_id(id) {
            // console.log(id);
            this.data.uni_org_filtered = this.data.uni_org.filter(uni => uni.pelouro_id == id)
        },
        uni_org_id(id) {
            this.data.sector_filtered = this.data.sector.filter(sec => sec.uni_org_id == id)
        }
    }
}
</script>

<style>

</style>
