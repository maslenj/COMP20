const renderBadges = (tags) => {
  let res = " "
  for (let tag of tags) {
    res += `<span class="badge bg-secondary">${tag}</span>&nbsp;`
  }
  return res
}

const highlightContainer = document.getElementById("highlighted-assignments")
const assignmentContainer = document.getElementById("main-assignments")

for (let assignment of assignments) {
  (assignment.hilighted ? highlightContainer : assignmentContainer).innerHTML +=
    `
      <div class="col-md-6 mb-3">
        <div class="card shadow-sm">
          <img class="card-img-top" src="./images/assignment${assignment.number}.png"
            alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">${assignment.assignment}: ${assignment.name}</h5>
            <p class="card-text">${assignment.description}</p>
            <p class="card-text">${renderBadges(assignment.tags)}</p>
            <a href="${assignment.link}" class="card-link">View assignment</a>
            <a href="${assignment.source}" class="card-link">View source code</a>
          </div>
        </div>
      </div>
    `
}