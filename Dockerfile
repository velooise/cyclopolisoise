FROM node:24 AS build

WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

RUN npm install

# Copy the rest of the application code to the working directory
COPY . .

# Build the Nuxt application for production
RUN npm run generate

# Stage 2: Serve the application
FROM nginx:alpine

# Copy the built application from the build stage
COPY --from=build /app/.output/public /usr/share/nginx/html

# Expose the port on which the application will run
EXPOSE 80

# Start the nginx server
CMD ["nginx", "-g", "daemon off;"]
