"use strict"

//toggler event, hide everything
$("#toggler").click(function() {
 $("#toggleEvent").toggle(2200);
});

//time function
(function () {
	function uhrzeit() {
		var jetzt = new Date(),
			h = jetzt.getHours(),
			m = jetzt.getMinutes(),
			s = jetzt.getSeconds();
		m = fuehrendeNull(m);
		s = fuehrendeNull(s);
		document.getElementById('uhr')
			.innerHTML = h + ':' + m + ':' + s;
		setTimeout(uhrzeit, 500);
	}

	function fuehrendeNull(zahl) {
		zahl = (zahl < 10 ? '0' : '') + zahl;
		return zahl;
	}
	document.addEventListener('DOMContentLoaded', uhrzeit);
}());


//msgbox confirmation
function msgBox()
{
  return window.confirm("Wirklich anmelden?");
}

//check in registration that at least one checkbox is checked
if(document.location.href.indexOf("register") > -1) {
	document.getElementById("registerButton").addEventListener("click", (event) => {
		let counter = 2;
		const checkBoxes = document.getElementById("checkBoxValidationForm")
		for (const checkBox of checkBoxes.children) {
			if(checkBox.children[0].checked === false) {
				counter--
			}
		}
		if (counter === 0) {
			event.preventDefault()
			window.alert("Bitte Männlich oder Weiblich ankreuzen")
			return
		}
		else if (counter === 2) {
			event.preventDefault()
			window.alert("Bitte nur ein Feld ankreuzen")
			return
		}
	})
}


//get every user with his ranking created in function above
if(document.location.href.indexOf("rankings") > -1) {

	const mensRanking = getTotalRanking("mensList")
	let mensCount = 1
	for (const men of mensRanking) {
		const trElement = document.createElement("tr")
		const thElementRanking = document.createElement("th") 
		const tdElementName = document.createElement("td")
		const tdElementPoints = document.createElement("td")

		const ranking = document.createTextNode(mensCount)
		const name = document.createTextNode(men.name)
		const points = document.createTextNode(men.points)

		thElementRanking.appendChild(ranking)
		tdElementName.appendChild(name)
		tdElementPoints.appendChild(points)
		trElement.appendChild(thElementRanking)
		trElement.appendChild(tdElementName)
		trElement.appendChild(tdElementPoints)

		mensCount++

		document.getElementById("mensWeeklyRanking").appendChild(trElement)
	}

	const womensRanking = getTotalRanking("womensList")
	let womensCount = 1
	for (const women of womensRanking) {
		const trElement = document.createElement("tr")
		const thElementRanking = document.createElement("th") 
		const tdElementName = document.createElement("td")
		const tdElementPoints = document.createElement("td")

		const ranking = document.createTextNode(womensCount)
		const name = document.createTextNode(women.name)
		const points = document.createTextNode(women.points)

		thElementRanking.appendChild(ranking)
		tdElementName.appendChild(name)
		tdElementPoints.appendChild(points)
		trElement.appendChild(thElementRanking)
		trElement.appendChild(tdElementName)
		trElement.appendChild(tdElementPoints)

		womensCount++

		document.getElementById("womensWeeklyRanking").appendChild(trElement)
	}

	//if weekly rankings are empty hide
	if (mensRanking.length > 0) {
		document.getElementById("mensRankingTable").classList.remove("d-none")
	} else {
		document.getElementById("mensRankingTable").classList.add("d-none")
	}
	if (womensRanking.length > 0) {
		document.getElementById("womensRankingTable").classList.remove("d-none")
	} else {
		document.getElementById("womensRankingTable").classList.add("d-none")
	}
}

//function create new array with users and results
function getTotalRanking(className) {
	const liElements = document.getElementsByClassName(className)
	const list = []
	//get every liElement and from these Get the innerText
	for (const liElement of liElements) {
		//get the listItems
		const listItems = liElement.children
		//loop trough every listitem
		let count = 1
		let sex
		let points
		for (const listItem of listItems) {
			if (className === "mensList") {
				sex = "male"
			}
			else {
				sex = "female"
			}
			//point system
			if (count === 1) {points = 25}
			if (count === 2) {points = 22}
			if (count === 3) {points = 20}
			if (count === 4) {points = 18}
			if (count === 5) {points = 16}
			if (count === 6) {points = 15}
			if (count === 7) {points = 14}
			if (count === 8) {points = 13}
			if (count === 9) {points = 12}
			if (count === 10) {points = 11}
			if (count === 11) {points = 10}
			if (count === 12) {points = 9}
			if (count === 13) {points = 8}
			if (count === 14) {points = 7}
			if (count === 15) {points = 6}
			if (count === 16) {points = 5}
			if (count === 17) {points = 4}
			if (count === 18) {points = 3}
			if (count === 19) {points = 2}
			if (count === 20) {points = 1}
			if (count > 20) {points = 0}
			//split strings
			const splittedValue = listItem.innerText.split(" ", 2)
			const nameArray = {
				sex: sex,
				name: splittedValue[0] + " " + splittedValue[1],
				points: points
			}

			//check if name exists
			const result = list.find(user => user.name === nameArray.name)
			if (result === undefined) {
				list.push(nameArray)
			}
			else {
				result.points = result.points + nameArray.points
			}

			count++
		}
	}
	list.sort((a, b) => (a.points < b.points) ? 1 : -1)
	return(list)
} 