
-- Insertion des catégories :
INSERT INTO categorie (titre_categorie) VALUES
('Programmation'),
('Design'),
('Marketing');

-- Insertion des cours :
INSERT INTO cours (id_en, titre, description, type_contenu, contenu_text, contenu_video, id_categorie, photo) VALUES
(5, 'Introduction à Python', 'Un cours complet pour débutants en Python', 'Texte', 'Contenu du cours texte Python', NULL, 1, 'python.jpg'),
(5, 'UX/UI Design', 'Apprendre les bases du design UX/UI', 'Video', NULL, 'ux_ui_video.mp4', 2, 'ux_ui.jpg'),
(5, 'Marketing Digital', 'Maîtrisez les fondamentaux du marketing digital', 'Video', NULL, 'marketing_video.mp4', 3, 'marketing.jpg');
