### How we refactored initial code from INITIAL CODE file.

1. Defined a good folder structure by adding all functionalities into `src` folder, application entry point into `public` folder, any configurations into `config` folder and added `composer.json` for autoloading.
2. We added dotenv package for manipulating with our enviroment variables which should never be hardcoded for security purposes.
3. From our `src` folder we divided each functionality per each folder, including all `Core` functionalities within `Core` folder. Core folder contain some classes that may not need to be there as if `INITIAL CODE` is only a part from a bigger codebase, but to make this code work we needed to add all of those classes like `Database, Validator, Router, Route, Config and helpers`.
4. We design our new database flow to allow us in any time with very small changes to change full database adapter from mysql, to sqlite, postgresql or any other. We would add that config to our `config/database.php -> connections` array and just make new repositories for that adapter.
5. For validation rules, we extended that code to DTO level where all validation rules can be assigned to each DTO property, then validated with out validator class and either returned validation errors or continued workflow with repositories.
6. Each validation rule has its own class, as most of our classes are single responsible, it is a lot easier and cleaner to create new rule class for new rules and use Attributes for their usage.
7. For MaxMind we created services folder, and within that service class we are faking thaat service response by throwing random values of 1 and 0, or true and false.  

### What can be improved

- Caching config variables instead of reading from files each time
- Session/Cookies classes, flash messages
- Writing more helpful repository methods
- Refactoring repositories with factory pattern to automatically select which ose is connected to which database adapter.
- Making a proper migrations functionality
- Handling request with a custom class or using Guzzle package
- Adding some views or view rendering  package like blade/twig

### Why we did this?

- Our codebase can be extended with various functionalities by keeping the same structure, by defining some core classes that would make future development easier we could put all of our time and energy into developing something new!

### Testing redactored code

```bash
curl -X POST \
  https://iae1k8srrz14pfqo9056.cleavr.xyz/register \
  -H 'Content-Type: application/json' \
  -d '{
    "email": "sasa@sasa.sasa",
    "password": "sasasasa",
    "password2": "sasasasa"
}'
```

