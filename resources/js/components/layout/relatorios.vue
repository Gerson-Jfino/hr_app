<template>
  <v-main class="grey lighten-3">
      <v-container>
        <v-row wrap>
            <v-col cols="12">
                <v-card>
                    <uniorg :data-inp="uniorgData"/>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-row>
                        <v-col cols="4">
                            <situacao :data-inp="situationData"/>
                        </v-col>
                        <v-col cols="4">
                            <genero :data-inp="generoData"/>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
      </v-container>
  </v-main>
</template>

<script>
import axios from 'axios'
import { BASE_URL } from '../../config/api'
import uniorg from './charts/uniorg.vue'
import situacao from './charts/situacao.vue'
import genero from './charts/genero.vue'
export default {
    components: {
        uniorg,
        situacao,
        genero
    },
    data() {
        return {
            total: 0,
            total_situation: [],
            uniorgData: {
                labels: [], data: []
            },
            situationData: {
                labels: [], data: []
            },
            generoData: {
                labels: [], data: []
            },
        }
    },
    created() {
        this.getStats()
    },
    methods: {
        async getStats() {
            const stats = (await axios.get(`${BASE_URL}relatorios`)).data
            this.total = stats.total_emplyes
            this.total_situation = stats.total_situation
            const employeOrgs = stats.employee_uniOrg
            const situation = stats.employee_situation
            const generos = stats.generos
            for (let org of employeOrgs) {
                const key = Object.keys(org)
                this.uniorgData.labels.push(key[0])
                this.uniorgData.data.push(org[key[0]])
            }
            for (let sit of situation) {
                const key = Object.keys(sit)
                this.situationData.labels.push(key[0])
                this.situationData.data.push(sit[key[0]])
            }
            for (let sit of generos) {
                const key = Object.keys(sit)
                this.generoData.labels.push(key[0])
                this.generoData.data.push(sit[key[0]])
            }
        }
    }

}
</script>

<style>

</style>