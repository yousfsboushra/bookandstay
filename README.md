# Book and Stay

## Assumptions and Decisions:

-   I decided not to use any framework because it is a simple API and most of the framework features will be overhead.

-   As an end user, I'm only interested in the final room price so I decided to only use the final prices and discard the net and tax.

-   According to the API samples I assumed that total price is always including the taxes.

-   I used composer as a package manager and for classes autoloading.

-   As you mentioned in the description that only GET method is allowed for APIs calling, I didn't implement other methods.

-   If an API fails, the code will continue normally with the other APIs.

-   I used PHPUnit for unit testing.

-   I have used a simple docker file to dockerize the application as a bonus task.

-   For simplicity, I've added the api input inside `input.json`, so instead of using Postman, you can call it directly from the browser.

-   To use file reader, the files must be placed inside `src` folder to be accessible to the docker environment.

## How to run the code:

-   Extract the files

-   Open the extracted folder

-   If port 9000 is not available on your device, you can change it in file `docker-compose.yml` line 6
    _Please note that some test cases depend on the docker port, so they won't succeed_

-   Build the docker: image using the command `docker-compose build`

-   Run the docker: image with the command `docker-compose up`

-   Now open your browser and go to http://localhost:9000

-   To change the input, just edit the `src/input.json` and refresh the page.

-   To run the unit test go to `src` folder and run command `composer test`
