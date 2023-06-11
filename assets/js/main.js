var dataURL = "http://localhost:10004/wp-json/options/all";
 
const app = Vue.createApp({
	data(){
		return {
			title: 'LEMONADE STAND',
			description: 'Let\'s build a cool Vue App!',
			newEmployee: false,
			currentEmployee: false,
			announcements: [],
			newTeam: [
				{ id: 1234, name: 'Kendall', startDate: '6/12/23', favSong: 'Sound of Silence' },
				{ id: 4321, name: 'John', startDate: '6/14/23', favSong: 'Dean Town'}
			],
			listItems: ['New Lunch & Learn Posted', 'New Employee Training', 'Upcoming Holiday']
		}
	},
	methods: {
		async getData() {
		  const res = await fetch("http://localhost:10004/wp-json/options/all");
		  const finalRes = await res.json();
		  this.announcements = finalRes;
		}
	},
	mounted() {
		this.getData()
	}
})