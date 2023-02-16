# CRUD Application by Krishnendu Bhowmick

A simple CRUD (Create, Read, Update, Delete) application built with PHP and MySQL by Krishnendu Bhowmick.

## Screenshot

![alt text](https://github.com/bhowmickkrishnendu/crud-db-app/blob/master/Screenshot.jpg?raw=true)

## Requirements

- Docker
- MySQL

## Installation

1. Clone the repository: `git clone https://github.com/bhowmickkrishnendu/crud-db-app.git`
2. Change directory: `cd crud-app`
3. Build the Docker image: `docker build --build-arg MYSQL_ROOT_PASSWORD=<your_root_password> --build-arg MYSQL_DATABASE=<your_database_name> --build-arg MYSQL_USER=<your_database_user> --build-arg MYSQL_PASSWORD=<your_database_password> --build-arg MYSQL_ROOT_HOST=<your_root_host> -t <your_image_name> .`
4. Start the application: `docker run -p 80:80 <your_image_name>`

## Usage

Once the application is running, you can access it in your web browser at http://localhost. You can perform CRUD operations on the Contacts table.

## License

This project is licensed under the MIT License - see the LICENSE file for details.
Note that the code snippet above is just an example and may not be related to the actual code of your CRUD application.


## Code Snippet

```php
// Get a single contact by ID
function getContact($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return null;
    }

    return $result->fetch_assoc();
}
