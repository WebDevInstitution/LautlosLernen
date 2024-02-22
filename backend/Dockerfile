# Offizielles Node.js-Image als Basis
FROM node:14

# Arbeitsverzeichnis im Container
WORKDIR /app

# Kopiere Abhängigkeiten und den Code
COPY package.json package-lock.json ./
COPY . .

# Installiere Abhängigkeiten
RUN npm install

# Starte Anwendung
CMD ["npm", "start"]
