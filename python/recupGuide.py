import requests
from bs4 import BeautifulSoup
import mysql.connector

def create_connection():
    # Connexion à la base de données MySQL
    try:
        conn = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="tech-news"
        )
        print("Connexion à la base de données réussie")
        return conn
    except mysql.connector.Error as e:
        print("Erreur lors de la connexion à la base de données:", e)
        return None

def guide_exists(conn, titre, url, libelle, image):
    # Création d'un curseur pour exécuter des requêtes SQL
    cursor = conn.cursor()
    
    # Requête pour vérifier si le guide existe déjà dans la base de données
    query = "SELECT COUNT(*) FROM guides WHERE titre = %s AND url_guide = %s AND libelle = %s AND url_image = %s"
    data = (titre, url, libelle, image)
    cursor.execute(query, data)
    count = cursor.fetchone()[0]
    
    # Retourne True si le guide existe déjà, False sinon
    return count > 0

def insert_guide(conn, titre, libelle, url, image, date_publication, auteur):
    titre = titre.replace('"', "'")
    libelle = libelle.replace('"', "'")
    date_publication = date_publication.replace('"', "'")
    auteur = auteur.replace('"', "'")

    # Création d'un curseur pour exécuter des requêtes SQL
    cursor = conn.cursor()
    
    # Insertion des données dans la base de données
    query = "INSERT INTO guides (titre, libelle, url_image, url_guide, auteur, date_publication) VALUES (%s, %s, %s, %s, %s, %s)"
    data = (titre, libelle, image, url, auteur, date_publication)
    try:
        cursor.execute(query, data)
        conn.commit()
        print("Guide inséré avec succès dans la base de données")
    except mysql.connector.Error as e:
        print("Erreur lors de l'insertion du guide:", e)

def get_popular_guides(url, conn):
    # Envoie une requête GET à l'URL spécifiée
    response = requests.get(url)
    
    # Vérifie si la requête a réussi
    if response.status_code == 200:
        # Analyse le contenu de la page avec BeautifulSoup
        soup = BeautifulSoup(response.text, 'html.parser')
        
        # Trouve tous les éléments contenant les titres, les libellés, les URL des guides et les URL des images
        guide_items = soup.find_all('div', class_='listingResult')[:10]  # Limiter à 10 guides
        
        # Pour chaque guide, extrait et insère les informations dans la base de données
        for item in guide_items:
            # Vérifie si le titre de l'article est présent
            title_elem = item.find('h3', class_='article-name')
            titre = title_elem.text.strip() if title_elem else None
            
            # Supprime les éléments <span class='free-text-label'> du libellé
            [s.extract() for s in item('span', class_='free-text-label')]
            
            # Vérifie si le libellé de l'article est présent
            synopsis_elem = item.find('p', class_='synopsis')
            libelle = synopsis_elem.text.strip() if synopsis_elem else None
            
            # Vérifie si l'image de l'article est présente
            image_elem = item.find('img')
            image = image_elem['src'] if image_elem else None
            
            # Vérifie si l'URL de l'article est présente
            url_elem = item.find('a', class_='article-link')
            url = url_elem['href'] if url_elem else None
            
            # Supposons que la date de publication et l'auteur se trouvent dans des balises spécifiques sur la page
            date_elem = item.find('time', class_='date-with-prefix')
            date_publication = date_elem.text.strip() if date_elem else None
            
            author_elem = item.find('span', class_='by-author')
            if author_elem:
                # Récupère tous les enfants de la balise <span class="by-author"> qui sont des balises <span>
                authors = author_elem.find_all('span')
                # Crée une liste pour stocker les auteurs
                authors_list = []
                for author in authors:
                    authors_list.append(author.text.strip())
                # Convertit la liste des auteurs en une chaîne de caractères séparée par des virgules
                auteur = ' '.join(authors_list)
            else:
                auteur = None
            
            # Vérifie si toutes les données nécessaires sont présentes
            if titre and libelle and image and url and date_publication and auteur:
                # Vérifie si le guide existe déjà dans la base de données
                if not guide_exists(conn, titre, url, libelle, image):
                    # Le guide n'existe pas encore, donc on peut l'insérer
                    insert_guide(conn, titre, libelle, url, image, date_publication, auteur)
                else:
                    print("Guide déjà présent dans la base de données, ignoré")
            else:
                print("Guide ignoré car des données essentielles sont manquantes")
    else:
        print("Erreur lors de la récupération de la page:", response.status_code)

# URL du site web contenant les guides populaires
url = "https://global.techradar.com/fr-fr/best"

# Connexion à la base de données
connection = create_connection()

# Appel de la fonction pour récupérer les guides populaires et les insérer dans la base de données
if connection:
    get_popular_guides(url, connection)
    connection.close()