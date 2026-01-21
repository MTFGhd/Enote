// Fonction de debounce pour optimiser les performances
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Fonction générique pour normaliser le texte (enlever accents, minuscules)
function normalizeText(text) {
    if (!text) return '';
    return text.toString()
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '');
}

// Fonction générique de filtrage de tableau
function filterTable(searchInput, filterSelect, tableBody, filterFunction) {
    const searchTerm = normalizeText(searchInput.value);
    const filterValue = filterSelect ? filterSelect.value : 'all';
    
    const rows = tableBody.querySelectorAll('tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const matchesSearch = filterFunction.search(row, searchTerm);
        const matchesFilter = filterFunction.filter(row, filterValue);
        
        if (matchesSearch && matchesFilter) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Afficher un message si aucun résultat
    updateNoResultsMessage(tableBody, visibleCount);
}

// Afficher un message "Aucun résultat" si nécessaire
function updateNoResultsMessage(tableBody, visibleCount) {
    const table = tableBody.closest('table');
    let noResultsRow = table.querySelector('.no-results-row');
    
    if (visibleCount === 0) {
        if (!noResultsRow) {
            const colCount = table.querySelectorAll('thead th').length;
            noResultsRow = document.createElement('tr');
            noResultsRow.className = 'no-results-row';
            noResultsRow.innerHTML = `
                <td colspan="${colCount}" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center gap-3">
                        <span class="material-symbols-outlined text-5xl text-[#64748b]">search_off</span>
                        <p class="text-slate-700 dark:text-gray-300 text-base font-medium">Aucun résultat trouvé</p>
                        <p class="text-[#64748b] text-sm">Essayez de modifier vos critères de recherche</p>
                    </div>
                </td>
            `;
            tableBody.appendChild(noResultsRow);
        }
    } else if (noResultsRow) {
        noResultsRow.remove();
    }
}

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    
    // === CLASSES ===
    const classesSearch = document.querySelector('[data-search="classes"]');
    const classesFilter = document.querySelector('[data-filter="classes"]');
    const classesTableBody = document.querySelector('[data-table="classes"]');
    
    if (classesSearch && classesTableBody) {
        const filterClasses = debounce(() => {
            filterTable(classesSearch, classesFilter, classesTableBody, {
                search: (row, searchTerm) => {
                    if (!searchTerm) return true;
                    const nom = normalizeText(row.querySelector('[data-nom]')?.textContent);
                    const code = normalizeText(row.querySelector('[data-code]')?.textContent);
                    return nom.includes(searchTerm) || code.includes(searchTerm);
                },
                filter: (row, filterValue) => {
                    if (filterValue === 'all') return true;
                    const departement = row.getAttribute('data-departement');
                    return departement === filterValue;
                }
            });
        }, 300);
        
        classesSearch.addEventListener('input', filterClasses);
        if (classesFilter) {
            classesFilter.addEventListener('change', filterClasses);
        }
    }
    
    // === ÉTUDIANTS ===
    const etudiantsSearch = document.querySelector('[data-search="etudiants"]');
    const etudiantsFilter = document.querySelector('[data-filter="etudiants"]');
    const etudiantsTableBody = document.querySelector('[data-table="etudiants"]');
    
    if (etudiantsSearch && etudiantsTableBody) {
        const filterEtudiants = debounce(() => {
            filterTable(etudiantsSearch, etudiantsFilter, etudiantsTableBody, {
                search: (row, searchTerm) => {
                    if (!searchTerm) return true;
                    const nom = normalizeText(row.querySelector('[data-nom]')?.textContent);
                    const prenom = normalizeText(row.querySelector('[data-prenom]')?.textContent);
                    const email = normalizeText(row.querySelector('[data-email]')?.textContent);
                    const code = normalizeText(row.querySelector('[data-code]')?.textContent);
                    return nom.includes(searchTerm) || 
                           prenom.includes(searchTerm) || 
                           email.includes(searchTerm) ||
                           code.includes(searchTerm);
                },
                filter: (row, filterValue) => {
                    if (filterValue === 'all') return true;
                    const classe = row.getAttribute('data-classe');
                    return classe === filterValue;
                }
            });
        }, 300);
        
        etudiantsSearch.addEventListener('input', filterEtudiants);
        if (etudiantsFilter) {
            etudiantsFilter.addEventListener('change', filterEtudiants);
        }
    }
    
    // === ABSENCES ===
    const absencesSearch = document.querySelector('[data-search="absences"]');
    const absencesTableBody = document.querySelector('[data-table="absences"]');
    
    if (absencesSearch && absencesTableBody) {
        const filterAbsences = debounce(() => {
            filterTable(absencesSearch, null, absencesTableBody, {
                search: (row, searchTerm) => {
                    if (!searchTerm) return true;
                    const etudiantNom = normalizeText(row.querySelector('[data-etudiant-nom]')?.textContent);
                    const etudiantPrenom = normalizeText(row.querySelector('[data-etudiant-prenom]')?.textContent);
                    const etudiantCode = normalizeText(row.querySelector('[data-etudiant-code]')?.textContent);
                    const cours = normalizeText(row.querySelector('[data-cours]')?.textContent);
                    const classe = normalizeText(row.querySelector('[data-classe]')?.textContent);
                    
                    return etudiantNom.includes(searchTerm) || 
                           etudiantPrenom.includes(searchTerm) ||
                           etudiantCode.includes(searchTerm) ||
                           cours.includes(searchTerm) ||
                           classe.includes(searchTerm);
                },
                filter: () => true // Pas de filtre pour les absences
            });
        }, 300);
        
        absencesSearch.addEventListener('input', filterAbsences);
    }
});

