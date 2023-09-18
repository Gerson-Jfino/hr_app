<template>
	<v-card

		tile
	>
		<v-app-bar
        style="background-color: white;"
		>
		<!-- <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon> -->

		Gugla
		<v-spacer></v-spacer>
		<v-toolbar-items>
			<v-menu
			offset-y
			>
				<template v-slot:activator="{ on, attrs }">
					<v-btn v-bind="attrs" v-on="on" depressed rounded text small>
						<div>
							{{ user?.name }}
						</div>
					</v-btn>
				</template>
				<v-list>
					<!-- <v-list-item> -->
					<v-list-item @click.prevent="logout">
						<v-list-item-icon><v-icon>mdi-logout</v-icon></v-list-item-icon>
						<v-list-item-title>Logout</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>

		</v-toolbar-items>
		</v-app-bar>

		<v-navigation-drawer
		v-model="drawer"
		fixed
		clipped
		app
		enable-resize-watcher
		height="100vh"
        permanent
		>
		<!--temporary-->
		<v-list
			nav
			dense
		>
			<v-list-item>

			</v-list-item>
			<v-list-item>

			</v-list-item>
			<v-list-item :to="{name: 'personal.data'}">
                <v-list-item-icon style="color:rgb(255, 153, 0);"><v-icon>mdi-clipboard-account </v-icon></v-list-item-icon>
				<v-list-item-title style="color:rgb(255, 153, 0);">Minha Ficha</v-list-item-title>
			</v-list-item>
			<v-list-item :to="{name: 'colaboradores.data'}">
                <v-list-item-icon style="color:rgb(255, 153, 0);"><v-icon>mdi-account-group </v-icon></v-list-item-icon>
				<v-list-item-title style="color:rgb(255, 153, 0);">Colaboradores</v-list-item-title>
			</v-list-item>
			<v-list-item :to="{name: 'personal.data'}">
                <v-list-item-icon style="color:rgb(255, 153, 0);"><v-icon>mdi-chart-line </v-icon></v-list-item-icon>
				<v-list-item-title style="color:rgb(255, 153, 0);">Relatórios</v-list-item-title>
			</v-list-item>

		</v-list>
		</v-navigation-drawer>
	</v-card>
</template>


<script>
export default {
    data() {
        return {
			drawer: true,
			group: null,
        }
    },
	methods: {
		logout() {
			this.$store.dispatch('Auth/logout')
			.then(() => {
				this.$router.push({name: 'login'})
			})
			.catch(() => {
				this.$router.push({name: 'login'})
			})
		}
	},
	created() {
		// setTimeout(()=> {
		// 	console.log(this.user);
		// }, 1000)
	},
	computed: {
		user() {
			const user = this.$store.state.Auth.user
			return user
		}
	}
}
</script>

<style>

</style>
