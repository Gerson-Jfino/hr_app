<template>
    <v-app id="inspire">
      <v-main class="grey lighten-3">
        <v-container>
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step
          :complete="e1 > 1"
          step="1"
        >
          Dados Pessoais
        </v-stepper-step>
  
        <v-divider></v-divider>
  
        <v-stepper-step
          :complete="e1 > 2"
          step="2"
        >
          Dados Empresariais
        </v-stepper-step>
  
        <v-divider></v-divider>
  
        <v-stepper-step step="3">
          Dados Academicos
        </v-stepper-step>
      </v-stepper-header>
  
      <v-stepper-items>
        <v-stepper-content step="1">
          <personal-data :user_id="user_id" @next="savedData()"/>
        </v-stepper-content>
  
        <v-stepper-content step="2">
          <employe-data :user_id="user_id" @next="savedData()"/>
        </v-stepper-content>
  
        <v-stepper-content step="3">
          <educationDataDialog :user_id="user_id" @next="savedData()"/>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
    </v-container>
    </v-main>
    </v-app>
  </template>
  <script>
import employeData from './forms/employeData.vue';
import personalData from './forms/personalData.vue';
import educationDataDialog from './educationDataDialog.vue';
import Axios from 'axios';
import { BASE_URL } from '../../config/api';
  
  export default {
    components: {personalData, employeData, educationDataDialog},
    data () {
      return {
        e1: 1,
        first_page: 0,
        user_id: null
      }
    },
    created() {
      this.getUserId()
      // setTimeout(() => {
      //   this.$router.push({name: 'colaboradores.data'})
      // }, 2000)
    },
    methods: {
      async getUserId() {
        // console.log('her');
        this.$store.state.Loader.loading = true
          this.user_id = (await Axios.get(`${BASE_URL}createTempUser`)).data.userId
          this.$store.state.Loader.loading = false
      },
      async savedData(){
        if (this.e1 < 3) {
          this.e1 = this.e1 + 1
        } else {
          this.$router.push({name: 'colaboradores.data'})
        }
      },
    }
  }
</script>