/*
 * TODO: Change to only one for-loop
 *
 */

const renderBadges = (tags) => {
  let res = " "
  for (let tag of tags) {
    res += `<span class="badge bg-secondary">${tag}</span>&nbsp;`
  }
  return res
}

for (let assignment of assignments) {
  document.getElementById("main-assignments").innerHTML +=
    `
      <div class="col-md-4 mb-3">
        <div class="card mb-6 shadow-sm">
          <img class="card-img-top" src="./images/assignment${assignment.number}.png"
            alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Assignment ${assignment.number}: ${assignment.name}</h5>
            <p class="card-text">${assignment.description}</p>
            <p class="card-text">${renderBadges(assignment.tags)}</p>
            <a href="Assignment${assignment.number}" class="card-link">View assignment</a>
            <a href="https://github.com/maslenj/COMP20/tree/master/Assignment${assignment.number}" class="card-link">View source code</a>
          </div>
        </div>
      </div>
  `
}

for (let highlight of highlights) {
  document.getElementById("highlighted-assignments").innerHTML +=
    `
      <div class="col-md-6 mb-3">
        <div class="card shadow-sm">
          <img class="card-img-top" src="./images/assignment${highlight.number}.png"
            alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">${highlight.assignment}: ${highlight.name}</h5>
            <p class="card-text">${highlight.description}</p>
            <p class="card-text">${renderBadges(highlight.tags)}</p>
            <a href="${highlight.link}" class="card-link">View assignment</a>
            <a href="${highlight.source}" class="card-link">View source code</a>
          </div>
        </div>
      </div>
  `
}