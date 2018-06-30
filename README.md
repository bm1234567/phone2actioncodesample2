
------------
Code Sample
------------

So, here's the premise I went with for demo purposes:


- Starting from nothing pre-made, put together a site with the following features:
    - Pulled a fresh/vanilla Laravel

    - Went with *monolithic* style MVC pattern since it sounds like some of your system
        is built this way.
    
    - Build some Tests around an objects CRUD pattern
        - went with Dusk tests around a Blog object
        (All Tests Pass if you run them:
            
            $ php artisan dusk
        )
        
    - Authentication/Authorization 
        - users only have access objects (e.g. Blog) they create
            (of course, privatizing 'Blog' makes it more of a personal journal, 
                but, I think you'll get the idea).
        
    -  Blog CRUD
        - includes: 
            - basic monolithic CRUD patterns
            - validation error handling on store() and update()
            - AJAX confirmDelete() modal / delete cycle using Vue()         
            - db stuff:
                - migrations  
                - factories for User and Blog
                - db seeding relating User and Blogs together
    
    - Basic Relationship scenario (User->Blogs)
        - defining
        - seeding
        - applying
        - globalScope (UserScope)
        
    - Basic Repository pattern implementation 
    
        *See Notes in: 
            [
            App\Repository\BlogRepository, 
            BlogController 
            ]*
        
    - Basic Vue changes since there was some BDD/Vue Code in the first code sample
        
    - Basic Styling with Bootstrap 4
            
    
-------------
Miscellaneous
-------------
- I intentionally left some commented out code in places to 
 show some 'before' and 'after'
 
- I intentionally left BlogRepository in the state it's in 
        *See Notes in: 
            [
            App\Repository\BlogRepository, 
            BlogController 
            ]*
    