### About:
The project is a web-based Task and Project Management System designed to facilitate collaboration and organization within a team. It includes user authentication and authorization functionalities, allowing two types of users, Managers and Teammates, to securely log in and manage their respective tasks and projects.

Managers can sign up by providing essential information such as Email, Name, Employee ID, and Password. Once logged in, Managers have the ability to create Teammates by supplying details like Name, Email, Employee ID, Position, and Password.

The core of the system revolves around Project Management, where Managers can create projects with unique Project Codes and Names. Within each project, Managers can create tasks, specifying Task Name, Project Code, Description, and Status (Pending, Working, Done).

Task Assignment and Status Management features enable Managers to assign tasks to Teammates, and Teammates can log in to view their assigned tasks and update their statuses.

The system also incorporates a Search and Filter functionality, allowing both Managers and Teammates to filter tasks based on Project and Status. Managers can further filter projects based on their name and filter tasks based on Teammates or Projects.

Overall, the system streamlines project and task management, enhancing collaboration, communication, and efficiency within the team.

### Steps:

1. **Clone the Repository:**

   Open a terminal or command prompt and navigate to the directory where you want to store your project. Run the following command to clone the Laravel project:

   ```bash
   git clone https://github.com/joy2362/ba_task.git
   ```

2. **Navigate to the Project Directory:**

   ```bash
   cd ba_task
   ```

3. **Install Dependencies:**

   Run the following command to install the project dependencies using Composer:

   ```bash
   composer install
   ```

4. **Copy Environment File:**

   Laravel uses an `.env` file for configuration. Copy the example file:

   ```bash
   cp .env.example .env
   ```

   Edit the `.env` file to set up your database configuration, app key, and other settings.

5. **Generate Application Key:**

   Run the following command to generate an application key:

   ```bash
   php artisan key:generate
   ```

6. **Database Migration:**

   Migrate the database using the following command:

   ```bash
   php artisan migrate
   ```

7. **Install Node module:**

   Install node module using the following command:

   ```bash
   npm install
   ```
8. **Run Npm:**

   Run npm using the following command:

   ```bash
   npm run dev
   ```

   or 

   ```bash
   npm run build
   ```

9. **Start the Development Server:**

   Launch the Laravel development server:

   ```bash
   php artisan serve
   ```

   By default, the server will be accessible at [http://localhost:8000](http://localhost:8000).

10. **Access the Application:**

   Open your web browser and navigate to [http://localhost:8000](http://localhost:8000) to see your Laravel application.

11. **Access the Swagger doc:**

   Open your web browser and navigate to [http://localhost:8000/api-doc](http://localhost:8000/api-doc) to see and run API.
