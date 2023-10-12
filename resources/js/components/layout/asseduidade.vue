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
            </v-row>
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
                                        <v-toolbar-title>Gestão de Asseduidade</v-toolbar-title>
                                        <v-divider
                                        class="mx-4"
                                        inset
                                        vertical
                                        ></v-divider>
                                        <v-spacer></v-spacer>
                                        <v-dialog
                                        v-model="dialog"
                                        max-width="600px"
                                        >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                            color="#ff9900"
                                            dark
                                            class="mb-2"
                                            v-bind="attrs"
                                            v-on="on"
                                            >
                                            Adicionar Asseduidade
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                            <!-- <span class="text-h5">{{ formTitle }}</span> -->
                                            </v-card-title>

                                            <v-card-text>
                                            <v-container>
                                                <v-row>
                                                    <v-col
                                                        cols="12"
                                                        md="12"
                                                    >
                                                        <v-select
                                                        label="Colaborador"
                                                        placeholder="selecione o colaborador"
                                                        :items="colaboradores"
                                                        item-text="nome_completo"
                                                        item-value="id"
                                                        v-model="editedItem.employe_id">

                                                        </v-select>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        md="6"
                                                    >
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
                                                                        dense
                                                                        v-model="editedItem.data_inicio"
                                                                        label="Data de inicio"
                                                                        append-icon="mdi-calendar"
                                                                        readonly
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                    ></v-text-field>
                                                            </template>
                                                            <v-date-picker
                                                                v-model="editedItem.data_inicio"
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
                                                        md="6"
                                                    >
                                                        <v-menu
                                                            ref="menu"
                                                            v-model="menu1"
                                                            :close-on-content-click="false"
                                                            :return-value.sync="date1"
                                                            transition="scale-transition"
                                                            offset-y
                                                            min-width="auto"
                                                        >
                                                            <template v-slot:activator="{ on, attrs }">
                                                                    <v-text-field
                                                                        dense
                                                                        v-model="editedItem.data_fim"
                                                                        label="Data fim"
                                                                        append-icon="mdi-calendar"
                                                                        readonly
                                                                        v-bind="attrs"
                                                                        v-on="on"
                                                                    ></v-text-field>
                                                            </template>
                                                            <v-date-picker
                                                                v-model="editedItem.data_fim"
                                                                dense
                                                                no-title
                                                                scrollable
                                                            >
                                                                <v-spacer></v-spacer>
                                                                <v-btn text color="primary" @click="menu1 = false">
                                                                    Cancel
                                                                </v-btn>
                                                                <v-btn text color="primary" @click="$refs.menu.save(date1)">
                                                                    OK
                                                                </v-btn>
                                                            </v-date-picker>
                                                        </v-menu>
                                                    </v-col>
                                                    <v-col cols="6">
                                                        <v-select
                                                        label="Absetismo"
                                                        required
                                                        :items="assiduidades_array"
                                                        v-model="editedItem.absentismo"
                                                        ></v-select>
                                                    </v-col>
                                                    <v-col
                                                        cols="6"
                                                        sm="6"
                                                    >
                                                        <v-text-field
                                                        label="Anexo"></v-text-field>
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                    name="input-7-1"
                                                    label="Observações"
                                                    v-model="editedItem.observacoes"
                                                    hint="Hint text"
                                                    ></v-textarea>
                                                    </v-col>
                                                    
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
                                                Cancel
                                            </v-btn>
                                            <v-btn
                                                color="blue darken-1"
                                                text
                                                @click="save()"
                                            >
                                                Save
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
                                    </v-toolbar>
                                    </template>
                                    <template v-slot:item.actions="{ item }">
                                    <v-icon
                                        small
                                        class="mr-2"
                                        @click="editItem(item)"
                                    >
                                        mdi-pencil
                                    </v-icon>
                                    <v-icon
                                        small
                                        @click="deleteItem(item)"
                                    >
                                        mdi-delete
                                    </v-icon>
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
      headers: [
        {
          text: 'Cod. Colaborador',
          align: 'start',
          sortable: false,
          value: 'id',
        },
        { text: 'Nome do Colaborador', value: 'nome_colaborador' },
        { text: 'absentismo', value: 'absentismo' },
        // { text: 'Data de Inicio', value: 'data_inicio', sortable: false },
        // { text: 'Data de Fim', value: 'data_fim', sortable: false },
        { text: 'Observações', value: 'observacoes' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
        assiduidades: [
        
        ],
        assiduidades_array: [
        'Ausente',
        'Dispensa',
        'Presente'
      ],
      colaboradores: [],
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
      this.getAsseduidades()
      this.getEmployes()
    },

    methods: {
      async getAsseduidades() {
        this.$store.state.Loader.loading = true
        this.assiduidades = (await Axios.get(`${BASE_URL}get-asseduidades`)).data
        this.$store.state.Loader.loading = false
      },
      async getEmployes() {
        this.$store.state.Loader.loading = true
        this.colaboradores = (await Axios.get(`${BASE_URL}get-colaboradores-list`)).data
        this.$store.state.Loader.loading = false
      },
      editItem (item) {
        this.editedIndex = this.assiduidades.indexOf(item)
        this.editedItem = Object.assign({}, item)
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
        if (this.editedIndex > -1) {
            await Axios.post(`${BASE_URL}update-asseduidades/${this.editedItem.id}`, this.editedItem)
            this.getAsseduidades()
            this.$store.state.Loader.loading = false
            Swal.fire({
                icon: 'success',
                title: 'Dados atualizada com sucesso',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            await Axios.post(`${BASE_URL}save-asseduidades`, this.editedItem)
            this.getAsseduidades()
            this.$store.state.Loader.loading = false
            Swal.fire({
                icon: 'success',
                title: 'Dados guardados com sucesso',
                showConfirmButton: false,
                timer: 1500
            })
        }
        this.close()
      },
    },
  }
</script>

<style>

</style>