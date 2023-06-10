const app = Vue.createApp({
	data(){
		return {
			title: 'LEMONADE STAND',
			description: 'Let\'s build a cool Vue App!',
			newEmployee: false,
			currentEmployee: false,
			announcements: ['New Lunch & Learn Posted', 'New Employee Training', 'Upcoming Holiday'],
			newTeam: [
				{ id: 1234, name: 'Kendall', startDate: '6/12/23', favSong: 'Sound of Silence' },
				{ id: 4321, name: 'John', startDate: '6/14/23', favSong: 'Dean Town'}
			]
		}
	}
})