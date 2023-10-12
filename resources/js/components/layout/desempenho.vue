<template>
  
    <v-main class="grey lighten-3">
      <v-container>
          <!-- <v-row>
              <v-col cols="12">
                      <v-card height="55px" style="background-color: rgba(128, 128, 128, 0.356);">
                          <v-card-text>
                              <v-row>
                                  <v-col cols="3" style="margin-top: -10px;">
                                      <v-text-field
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
                                  </v-col>
                                  <v-col cols="2" style="margin-top: -10px;">
                                     
                                  </v-col>
                              </v-row>
                          </v-card-text>
                      </v-card>
                
              </v-col>
          </v-row> -->
          <row>
              <v-col cols="12">
                  <v-sheet rounded="lg">
                      <v-card>
                          <v-card-text>
                              <v-data-table
                                  :headers="headers"
                                  :items="assiduidades"
                                  class="elevation-1"
                              >
                                  <template v-slot:top>
                                  <v-toolbar
                                      flat
                                  >
                                      <v-toolbar-title>Gestão de Avaliação de desempenho</v-toolbar-title>
                                      <v-divider
                                      class="mx-4"
                                      inset
                                      vertical
                                      ></v-divider>
                                      <v-spacer></v-spacer>
                                      <v-dialog
                                      v-model="dialog"
                                      max-width="600"
                                      >
                                      <!-- <template v-slot:activator="{ on, attrs }">
                                          <v-btn
                                          color="#ff9900"
                                          dark
                                          class="mb-2"
                                          v-bind="attrs"
                                          v-on="on"
                                          >
                                          Adicionar Asseduidade
                                          </v-btn>
                                      </template> -->
                                      <v-card width="600px">
                                          <v-card-title>
                                          <!-- <span class="text-h5">{{ formTitle }}</span> -->
                                          </v-card-title>

                                          <v-card-text>
                                          <v-container>
                                              <v-row>
                                                <v-data-table
                                                    :headers="headers2"
                                                    :items="userDesempenhos"
                                                    class="elevation-1"
                                                >
                                                    <template v-slot:top>
                                                        <v-toolbar flat>
                                                            <!-- //table 2 -->
                                                            <v-toolbar-title>{{ editedCol.nome_completo }}</v-toolbar-title>
                                                                <v-divider
                                                                class="mx-4"
                                                                inset
                                                                vertical
                                                                ></v-divider>
                                                                <v-spacer></v-spacer>
                                                                <v-dialog
                                                                v-model="dialog2"
                                                                max-width="500px"
                                                                >
                                                                <template v-slot:activator="{ on, attrs }">
                                                                    <v-btn
                                                                    color="primary"
                                                                    dark
                                                                    class="mb-4"
                                                                    v-bind="attrs"
                                                                    v-on="on"
                                                                    >
                                                                    Avaliar
                                                                    </v-btn>
                                                                </template>
                                                                <v-card>
                                                                    <v-card-title>
                                                                    <span class="text-h5">Avaliar Colaborador</span>
                                                                    </v-card-title>

                                                                    <v-card-text>
                                                                    <v-container>
                                                                        <v-row>
                                                                        
                                                                            <v-col
                                                                                cols="12"
                                                                            >
                                                                            <!-- v-model="editedItem.protein" -->
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
                                                                                                v-model="avaliacao.data_avalicao"
                                                                                                label="Data da situação"
                                                                                                append-icon="mdi-calendar"
                                                                                                readonly
                                                                                                v-bind="attrs"
                                                                                                v-on="on"
                                                                                                :error-messages="errors"
                                                                                            ></v-text-field>
                                                                                    </template>
                                                                                    <v-date-picker
                                                                                        v-model="avaliacao.data_avalicao"
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
                                                                            <v-col
                                                                                cols="12"
                                                                            >
                                                                            <!-- v-model="editedItem.protein" -->
                                                                                <v-select
                                                                                outlined
                                                                                dense
                                                                                :items="avaliacoes"
                                                                                label="Resultado da Avaliação"
                                                                                v-model="avaliacao.avaliacao"
                                                                                ></v-select>
                                                                            </v-col>
                                                                            <v-col
                                                                                cols="12"
                                                                            >
                                                                            <!-- v-model="editedItem.protein" -->
                                                                            <v-file-input
                                                                            label="Anexar o formulario preenchido"
                                                                            outlined
                                                                            dense
                                                                            v-model="avaliacao.anexo"></v-file-input>
                                                                            </v-col>
                                                                        </v-row>
                                                                    </v-container>
                                                                    </v-card-text>

                                                                    <v-card-actions>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn
                                                                        color="error darken-1"
                                                                        text
                                                                        @click="close2"
                                                                    >
                                                                        Cancelar
                                                                    </v-btn>
                                                                    <v-btn
                                                                        color="blue darken-1"
                                                                        text
                                                                        @click="save"
                                                                    >
                                                                        Avaliar
                                                                    </v-btn>
                                                                    </v-card-actions>
                                                                </v-card>
                                                                </v-dialog>
                                                                <v-dialog v-model="dialogDelete" max-width="500px">
                                                                <v-card>
                                                                    <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                                                                    <v-card-actions>
                                                                    <v-spacer></v-spacer>
                                                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                                                    <v-spacer></v-spacer>
                                                                    </v-card-actions>
                                                                </v-card>
                                                                </v-dialog>

                                                            <!-- //end table 2 -->
                                                        </v-toolbar>
                                                    </template>
                                                </v-data-table>
                                                  
                                              </v-row>
                                          </v-container>
                                          </v-card-text>

                                          <v-card-actions>
                                          <v-spacer></v-spacer>
                                          <v-btn
                                              color="blue darken-1"
                                              text
                                              @click="close"
                                          >
                                              Fechar
                                          </v-btn>
                                          <!-- <v-btn
                                              color="blue darken-1"
                                              text
                                              @click="save()"
                                          >
                                              Save
                                          </v-btn> -->
                                          </v-card-actions>
                                      </v-card>
                                      </v-dialog>
                                      <!-- <v-dialog v-model="dialogDelete" max-width="500px">
                                      <v-card>
                                          <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                                          <v-card-actions>
                                          <v-spacer></v-spacer>
                                          <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn> -->
                                          <!-- <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                          <v-spacer></v-spacer>
                                          </v-card-actions>
                                      </v-card>
                                      </v-dialog> -->
                                  </v-toolbar>
                                  </template>
                                  <template v-slot:item.actions="{ item }">
                                    <v-btn
                                    depressed 
                                    rounded
                                    small
                                    style="color:rgb(255, 153, 0);"
                                    @click="editItem(item)"
                                    >
                                        Ver Avaliações
                                    </v-btn>
                                  <!-- <v-icon
                                      small
                                      class="mr-2"
                                      @click="editItem(item)"
                                  >
                                      mdi-pencil
                                  </v-icon> -->
                                  
                                  </template>
                              </v-data-table>
                          </v-card-text>
                      </v-card>
                  </v-sheet>
              </v-col>
          </row>
      </v-container>
    </v-main>


</template>

<script>
import Axios from 'axios';
import { BASE_URL } from '../../config/api'
import Swal from "sweetalert2";
export default {
  data: () => ({
      date: new Date().toISOString().substr(0, 10),
      menu: false,
    dialog: false,
    dialogDelete: false,
    dialog2: false,
    editedCol: {},
    menu: false,
    date: new Date().toISOString().substr(0, 10),
    headers: [
      {
        text: 'Cod. Colaborador',
        align: 'start',
        sortable: false,
        value: 'id',
      },
      { text: 'Nome do Colaborador', value: 'nome_completo' },
      { text: 'Unidade Organica', value: 'uni_org' },
      // { text: 'Data de Inicio', value: 'data_inicio', sortable: false },
      // { text: 'Data de Fim', value: 'data_fim', sortable: false },
      { text: 'Sector', value: 'sector' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    avaliacoes: [
        'Muito Bom',
        'Bom',
        'Suficiente',
        'Mau'
    ],
    headers2: [
    {
        text: 'Data da avaliação',
        align: 'start',
        sortable: false,
        value: 'data_avalicao',
          width: "40%"
      },
      { text: 'Resultado da avaliação', value: 'avaliacao', width: "40%" },
      { text: 'Anexo', value: 'anexo', width: "40%" },
      // { text: 'Data de Inicio', value: 'data_inicio', sortable: false },
      // { text: 'Data de Fim', value: 'data_fim', sortable: false }
    ],
      assiduidades: [
      
      ],
      assiduidades_array: [
      'Ausente',
      'Dispensa',
      'Presente'
    ],
    colaboradores: [],
    avaliacao: {
        data_avalicao: null,
        avaliacao: "",
        anexo: null
    },
    userDesempenhos: [],
    editedIndex: -1,
    editedItem: {
      id: '',
      employe_id: null,
      nome_colaborador: '',
      absentismo: '',
      data_inicio: null,
      data_fim: null,
      observacoes: '',
    },
    defaultItem: {
      id: '',
      employe_id: null,
      nome_colaborador: '',
      absentismo: '',
      data_inicio: null,
      data_fim: null,
      observacoes: '',
    },
  }),

  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
  },

  created () {
    this.getDesempenhos()
  },

  methods: {
    async getDesempenhos() {
      this.$store.state.Loader.loading = true
      this.assiduidades = (await Axios.get(`${BASE_URL}get-desempenhos`)).data
      this.$store.state.Loader.loading = false
    },
    async getEmployes() {
      this.$store.state.Loader.loading = true
      this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores-list`)).data
      this.$store.state.Loader.loading = false
    },
    editItem (item) {
      console.log(item);
      this.userDesempenhos = item.desempenho
      this.editedCol = item
    //   this.editedIndex = this.assiduidades.indexOf(item)
    //   this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.editedIndex = this.assiduidades.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      this.assiduidades.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },
    close2 () {
      this.dialog2 = false
      this.avaliacao = {
        data_avalicao: null,
        avaliacao: "",
        anexo: null
    }
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    async save () {
      // console.log('ok');
      this.$store.state.Loader.loading = true
          const formData = new FormData()
          formData.append('data_avalicao', this.avaliacao.data_avalicao)
          formData.append('avaliacao', this.avaliacao.avaliacao)
          formData.append('employe_id', this.editedCol?.id)
          if (this.avaliacao.anexo !== null && typeof(this.avaliacao.anexo) !== 'string' ) {
                formData.append('anexo', this.avaliacao.anexo)
            }
          await Axios.post(`${BASE_URL}save-desempenho`, formData)
          this.getDesempenhos()
          this.$store.state.Loader.loading = false
          Swal.fire({
              icon: 'success',
              title: 'Dados guardados com sucesso',
              showConfirmButton: false,
              timer: 1500
          })
      
      this.close()
      this.close2()
    },
  },
}
</script>

<style>

</style>