console.log(assignments)

for (let assignment of assignments) {
  document.getElementById("main-assignments").innerHTML +=
    `
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          <img class="card-img-top" src="./images/assignment${assignment.number}.png"
            alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Assignment ${assignment.number}: ${assignment.name}</h5>
            <p class="card-text">${assignment.description}</p>
            <a href="Assignment${assignment.number}" class="card-link">View assignment</a>
            <a href="https://github.com/maslenj/COMP20/tree/master/Assignment${assignment.number}" class="card-link">View source code</a>
          </div>
        </div>
      </div>
  `
}