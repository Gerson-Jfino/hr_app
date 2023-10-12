<template>
  <v-main class="grey lighten-3">
      <v-container>
        <v-row wrap>
            <v-col cols="6" md="2" v-for="situation in total_situation" :key="situation.name">
                <v-card height="80px" width="280px">
                    <v-card-text>
                        <div>Colaboradores {{ situation.situation_name }}</div>
                        <div>
                            <v-progress-linear
                            color="light-blue"
                            height="15"
                            :value="situation.count"
                            striped
                            >
                                <template v-slot:default="{value}">{{ (value*100)/total }} %</template>
                            </v-progress-linear>
                        </div>
                        <div>
                            {{ situation.count }} / {{ total }}
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
      </v-container>
  </v-main>
</template>

<script>
import axios from 'axios'
import { BASE_URL } from '../../config/api'
export default {
    data() {
        return {
            total: 0,
            total_situation: []
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
        }
    }

}
</script>

<style>

</style>