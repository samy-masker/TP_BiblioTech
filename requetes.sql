/* livres avec nom emprunts */
SELECT l.titre, l.auteur, COUNT(e.id) AS nb_emprunts
FROM livre l
LEFT JOIN emprunt e ON e.livre_id = l.id
GROUP BY l.id
ORDER BY nb_emprunts DESC;

/* livres en cours d'emprunt */
SELECT l.titre, l.auteur, e.date_emprunt
FROM emprunt e
JOIN livre l ON l.id = e.livre_id
WHERE e.date_retour IS NULL;

/* emrprunt d'un adhérent (via id) */
SELECT l.titre, e.date_emprunt, e.date_retour
FROM emprunt e
JOIN livre l ON l.id = e.livre_id
WHERE e.adherent_id = 1;

/* livres les + empruntés */
SELECT l.titre, l.auteur, COUNT(e.id) AS nb_emprunts
FROM livre l
LEFT JOIN emprunt e ON e.livre_id = l.id
GROUP BY l.id
ORDER BY nb_emprunts DESC
LIMIT 5;

/* adhérents n'ayant jamais emprunté */
SELECT a.nom, a.email
FROM adherent a
LEFT JOIN emprunt e ON e.adherent_id = a.id
WHERE e.id IS NULL;