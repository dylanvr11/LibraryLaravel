<template>
	<table class="table" id="bookTable" @click="getEvent">
		<!-- <table class="table" id="bookTable" @v-if="load" @click="getEvent"> -->
		<thead>
			<tr>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Stock</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<!-- esto se va con el datatable <tr v-for="(book, index) in books" :key="index">
				<th>{{ book.title }}</th>
				<td>{{ book.author.name }}</td>
				<td>{{ book.stock }}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getbook(book)">Editar</button>
					-- anta de ante datatable <button class="btn btn-warning me-2" @click="getbook(book.id)">Editar</button> --
					<button class="btn btn-danger" @click="deleteBook(book)">Eliminar</button>
				</td>
			</tr> -->
		</tbody>
	</table>
</template>

<script>
	export default {
		data() {
			return {
				books: [],
				datatable: {}
			}
		},
		/*
	       para datatable esto de abajo se cambia
		created() {
			this.index()
		},
	       */
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				// se elimina para datatablesthis.books = [...this.books_data]
				// await this.getBooks()
				// setTimeout(() => this.mountDataTable(), 200)
				this.mountDataTable()
				// antes da el error de getbooks no se tiene this.mountDataTable()
			},
			mountDataTable() {
				/*
				setTimeout(() => {
					$('#bookTable').DataTable()
				}, 200)
	               ya no es necesario esperar con la moficiaciones
	               */
				this.datatable = $('#bookTable').DataTable({
					Processing: true,
					serverSide: true,
					ajax: {
						url: '/Books/GetAllBooksDataTable'
					},
					columns: [
						{ data: 'title' },
						{ data: 'author.name', searchable: false },
						{ data: 'stock' },
						{ data: 'action' }
					],
					error: function (xhr, error, code) {
						console.log(xhr, code)
					}
				})
			},
			//async getbook(book_id)
			async getBooks() {
				try {
					// this.load = false
					const { data } = await axios.get('Books/GetAllBooks')
					this.books = data.books
					// this.load = true
				} catch (error) {
					console.error(error)
				}
				this.mountDataTable()
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') == 'edit') {
					this.getBook(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deleteBook(button.getAttribute('data-id'))
				}
			},
			// async getbook(book)
			async getBook(book_id) {
				try {
					/*
					const { data } = await axios.get(`Books/GetABook/${book_id}`)
	                   {book.id}
	                   this.$parent.editBook(data.book)
	                   */
					/* otra forma
					 */
					// this.$parent.editBook(book)
					this.datatable.destroy()
					const { data } = await axios.get(`Books/GetABook/${book_id}`)
					this.$parent.editBook(data.book)
					this.index()
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!'
					})
				}
			},
			// async deleteBook(book)
			async deleteBook(book_id) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Quiere eliminar el libro?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})
					if (!result.isConfirmed) return
					this.datatable.destroy()
					// this.load = false
					await axios.delete(`Books/DeleteABook/${book_id}`)
					this.index()
					swal.fire({
						icon: 'success',
						title: 'Felicitaciones!',
						text: 'Libro Eliminado!'
					})
				} catch (error) {
					console.error(error)
					/*
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal!'
					})
					*/
				}
			}
		}
	}
</script>
