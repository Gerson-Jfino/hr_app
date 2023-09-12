<template>
  <v-app id="inspire">
    <v-main class="grey lighten-3">
      <v-container>
        <v-row>
          <v-col cols="3">
            <v-sheet rounded="lg">
              <v-card>
                <v-divider></v-divider>
                <v-card-title>
                  <v-row align="center">
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: 20px"
                    >
                      <v-avatar
                        class="profile avatar-center-heigth avatar-shadow"
                        color="grey"
                        size="60"
                      >
                        <span style="color: aliceblue">GM</span>
                      </v-avatar>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                    >
                      <div class="grey--text ms-1">001212</div>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <v-card-title
                        ><strong> Gerson Maoze</strong></v-card-title
                      >
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <div class="grey--text ms-4" style="font-size: small">
                        Direção de Tecnlogia de Informatica
                      </div>
                    </v-col>
                    <v-col
                      align-self="start"
                      class="d-flex justify-center align-center pa-0"
                      cols="12"
                      style="margin-top: -20px"
                    >
                      <div class="" style="font-size: small">
                        Pelouro de De destribuição Comercial e Informatica
                      </div>
                    </v-col>
                  </v-row>
                </v-card-title>
                <v-divider class="mx-4"></v-divider>

                <v-card-text>
                  <v-row>
                    <v-card-title> Dados Pessoais </v-card-title>
                    <v-btn
                      class="ma-4"
                      outlined
                      color="indigo"
                      small
                      @click="dialog = true"
                    >
                      <v-icon small>mdi-pencil</v-icon>
                      Editar
                    </v-btn>

                    <v-dialog v-model="dialog" persistent max-width="900px">
                      <v-toolbar color="secondary" dark>
                        <v-row> Ficha de Dados Pessoais </v-row>
                      </v-toolbar>
                      <personl-data-dialog @closeDialog="closePesonalForm" />
                    </v-dialog>
                  </v-row>

                  <!-- <v-row
                        align="center"
                        class="mx-0"
                    >
                        <v-rating
                        :value="4.5"
                        color="amber"
                        dense
                        half-increments
                        readonly
                        size="14"
                        ></v-rating>

                        <div class="grey--text ms-4">
                        4.5 (413)
                        </div>
                    </v-row> -->
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon style="margin-top: 2px">
                        mdi-cake-variant
                      </v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >12/01/1997</span
                      ><br />
                      <span
                        class="grey--text ms-4"
                        style="font-size: small; margin-top: -20px"
                        >27 Anos</span
                      >
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-account-box </v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >MOÇAMBICANO</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >MASCULINO</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >NUIT: 123456789</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >DOCUMENTO: 123455656</span
                      ><br />
                    </v-col>
                  </v-row>

                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-map-marker</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >Cidade de Maputo</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >Endereço, Maputo Magoanine</span
                      ><br />
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-cellphone</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >841212121</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >841212121</span
                      ><br />
                      <span class="grey--text ms-4" style="font-size: small"
                        >841212121</span
                      ><br />
                    </v-col>
                  </v-row>
                  <v-row align="center" class="mx-0">
                    <v-col cols="1">
                      <v-icon> mdi-email</v-icon>
                    </v-col>
                    <v-col cols="8">
                      <span class="grey--text ms-4" style="font-size: small"
                        >gersonjfmaoze@gmail.com</span
                      ><br />
                    </v-col>
                  </v-row>
                </v-card-text>

                <v-divider class="mx-4"></v-divider>
              </v-card>
            </v-sheet>
          </v-col>

          <v-col>
            <v-sheet min-height="70vh" rounded="lg">
              <v-card>
                <v-row>
                  <v-card-title>Dados Empresariais </v-card-title>
                  <v-btn
                    class="ma-4"
                    outlined
                    color="indigo"
                    small
                    @click="
                      () => {
                        dialogCompany = true;
                      }
                    "
                  >
                    <v-icon small>mdi-pencil</v-icon>
                    Editar
                  </v-btn>
                  <v-dialog
                    v-model="dialogCompany"
                    persistent
                    max-width="900px"
                  >
                    <v-toolbar color="secondary" dark>
                      <v-row> Ficha de Dados Empresariais </v-row>
                    </v-toolbar>
                    <company-data-dialog
                        :personal-data-form="employee"
                      @closeCompanyDialig="closeCompanyDialig"
                    />
                  </v-dialog>
                </v-row>
                <v-row>
                  <v-card-text>
                    <div class="font-weight-bold ml-8 mb-2">
                      Codigo Trabalhador: 001231
                    </div>
                    <v-timeline align-top dense>
                      <v-timeline-item
                        color="orange"
                        small
                        style="margin-top: -30px"
                      >
                        <div class="grey--text" style="font-size: small">
                          Pelouro de De destribuição Comercial e Informatica
                          &#x2022; GCA-Gab. do Conselho de Administração
                        </div>
                        <div class="grey--text" style="font-size: small">
                          &#x2022; GCA-Serviços de Apoio
                        </div>
                        <div class="font-weight-normal">
                          <strong>Gerson Josefino Maoze</strong> &#x2022;
                          <span class="grey--text"> Licenciado </span>
                        </div>
                        <div><strong>Support 1</strong></div>
                        <div>
                          <div
                            class="font-weight-normal"
                            style="font-size: small"
                          >
                            <strong>Data inicio</strong> &#x2022; 23/12/2019 -
                            <strong>Data inicio</strong> &#x2022; 23/12/2027
                          </div>
                          <div>
                            <strong>Reforma</strong> &#x2022; 20/01/2021
                          </div>
                        </div>
                      </v-timeline-item>
                    </v-timeline>
                  </v-card-text>
                </v-row>
              </v-card>
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import axios from 'axios'
import { BASE_URL } from '../../config/api'
import companyDataDialog from "./companyDataDialog.vue";
import personlDataDialog from "./personlDataDialog.vue";
export default {
  components: { personlDataDialog, companyDataDialog },
  data: () => ({
    links: ["Dashboard", "Messages", "Profile", "Updates"],
    dialog: false,
    dialogCompany: true,
    employee: {
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
    }
  }),
  created() {
    this.getMe()
  },
  methods: {
    closePesonalForm() {
      this.dialog = false;
    },
    closeCompanyDialig() {
      this.dialogCompany = false;
    },
    async getMe() {
        this.$store.state.Loader.loading = true
        const me = (await axios.get(`${BASE_URL}me`)).data
        this.employee = me.employee
        console.log(this.employee);
        this.$store.state.Loader.loading = false
    }
  },
};
</script>

