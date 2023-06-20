<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Libros</h2>
			<button @click="openModal" class="btn btn-primary">Crear libro</button>
		</div>
		<div class="card-body">
			<table-component ref="table" />
			<!--             se elimina load
			-- Load --
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section> -->
			<section v-if="load_modal">
				<modal :book_data="book" />
			</section>
		</div>
	</div>
</template>

<script>
	import TableComponent from './Table.vue'
	import Modal from './Modal.vue'

	export default {
		components: {
			TableComponent,
			Modal
		},
		data() {
			return {
				load_modal: false,
				modal: null,
				book: null
			}
		},
		/* se elimina created cuando colocamos el datatable
		created() {
			this.index()
		},
	       */
		/*
		methods: {
			index() {
				this.books = this.getBooks()
			},
			async getBooks() {
				//funcion flecha
				return axios
					.get('/api/Books/GetAllBooks')
					.then(response => {
						//funcion flecha
						this.books = response.data.books
						console.log(this.books)
					})
					.catch(error => {
						console.log('hola')
						console.error(error)
					})
				//return axios.get('/api/Books/GetAllBooks').then(function(res){}) //funcion nombrada
			}
	       }
	       */
		methods: {
			/*
	           eliminado datatable
			async index() {
				await this.getBooks()
			},
	           */
			/*
			async getBooks() {
				try {
					/*
					// otra forma
					axios.get('/api/Books/GetAllBooks').then(({ data: { books } }) => {
						console.log(books)
					}) acá antes

					this.load = false
					const { data } = await axios.get('Books/GetAllBooks')
					this.books = data.books
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
	           */
			openModal() {
				this.load_modal = true
				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('book_modal'), {
						Keyboard: false
					})
					this.modal.show()
					const modal = document.getElementById('book_modal')
					modal.addEventListener('hidden.bs.modal', () => {
						// console.log(modal)
						this.load_modal = false
						this.book = null
					})
				}, 200)
			},
			closeModal() {
				this.modal.hide()
				this.$refs.table.datatable.destroy()
				this.$refs.table.index()
			},
			editBook(book) {
				this.book = book
				this.openModal()
			}
		}
	}
</script>
