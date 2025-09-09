document.getElementById('year').textContent = new Date().getFullYear();
fetch('projects.json')
  .then(r => r.json())
  .then(items => {
    const grid = document.getElementById('project-grid');
    items.forEach(p => {
      const col = document.createElement('div');
      col.className = 'col-md-6 col-lg-4';
      col.innerHTML = `
        <div class="card h-100 rounded-4 shadow-sm">
          <div class="card-body d-flex flex-column">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h3 class="h5 mb-0">${p.title}</h3>
              <span class="badge text-bg-dark">${p.stack}</span>
            </div>
            <p class="text-muted small flex-grow-1">${p.summary}</p>
            <div class="d-flex gap-2">
              ${p.links.repo ? `<a class="btn btn-sm btn-outline-dark" target="_blank" href="${p.links.repo}">Repo</a>` : ''}
              ${p.links.demo ? `<a class="btn btn-sm btn-dark" target="_blank" href="${p.links.demo}">Demo</a>` : ''}
            </div>
          </div>
        </div>`;
      grid.appendChild(col);
    });
  })
  .catch(() => {
    document.getElementById('project-grid').innerHTML = '<p class="text-muted">Edita projects.json para listar tus proyectos.</p>';
  });
