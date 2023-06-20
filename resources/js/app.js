import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------
import ExampleComponent from './components/ExampleComponent.vue'
import BooksList from './components/Books/Index.vue'

const app = createApp({
	components: {
		ExampleComponent,
		BooksList
	}
})

app.component('v-select', vSelect)
app.mount('#app')
