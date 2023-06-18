var dataURL = "http://localhost:10004/wp-json/options/all";
 
const app = Vue.createApp({
	data(){
		return {
			title: 'LEMONADE STAND',
			description: 'Let\'s build a cool Vue App!',
			newEmployee: false,
			currentEmployee: false,
			announcements: [],
			team: [
				//{ id: 1234, name: 'Kendall', startDate: '6/12/23', favSong: 'Sound of Silence' },
				//{ id: 4321, name: 'John', startDate: '6/14/23', favSong: 'Dean Town'}
			],
			newTeam: [],
			birthdays: [],
			anniversaries: [],
			listItems: ['New Lunch & Learn Posted', 'New Employee Training', 'Upcoming Holiday'],
			likes: 0
		}
	},
	methods: {
		async getAnnouncements() {
		    const res = await fetch("http://localhost:10004/wp-json/options/all");
		    const finalRes = await res.json();
		    this.announcements = finalRes;
		},
		async getTeam() {
			const res = await fetch("http://localhost:10004/wp-json/wp/v2/users?per_page=100");
		    const finalRes = await res.json();
		    this.team = finalRes;
			console.log(this.team);
		},
		saturateDate() {
			const date = new Date();
			let currentDate = new Date().toJSON().slice(0, 10);
			console.log(currentDate);
		},
		addLikes() {
			this.likes += 1
		},
		getNewTeam() {
			console.log("Start saturating New Team.")
			this.team.forEach(member => {
				if(member.hire_date){
					console.log("Success! We've retrieved each New team member based on a condition.")
					this.newTeam.push(member)
				}
			})
		},
		getBirthdays(){
			console.log("Start saturating Birthdays.")
			this.team.forEach(member => {
				console.log(member.birthday)
				if(member.birthday){
					console.log("Success! We've retrieved each team member Birthday based on a condition.")
					this.birthdays.push(member)
				}
			})
		},
		getAnniversaries(){
			console.log("Start saturating Anniversaries.")
			this.team.forEach(member => {
				if(member.hire_date == "6/15/2023"){
					console.log("Success! We've retrieved each team member Anniversary based on a condition.")
					this.anniversaries.push(member)
				}
			})
		}
	},
	mounted() {
		this.getAnnouncements()
		this.getTeam()
		this.saturateDate()
		this.getNewTeam()
		this.getBirthdays()
		this.getAnniversaries()
	}
})