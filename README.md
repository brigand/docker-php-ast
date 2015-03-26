Simple docker container to generate php ast in a JSON format.  It's ugly, but it works.

    $ docker run -i --rm brigand/php-ast < some_file.php

Real example run on the script here (this is so meta!)

    $ docker run -i --rm php-ast < stdin_to_ast_json.php | jq . | head -n 500 | tail -n 50
                                  "type": "int",
                                  "value": "11"
                                },
                                "endLine": {
                                  "type": "int",
                                  "value": "11"
                                },
                                "children": [
                                  {
                                    "type": "name",
                                    "value": {
                                      "type": "string",
                                      "value": "this"
                                    }
                                  }
                                ]
                              }
                            },
                            {
                              "type": "name",
                              "value": {
                                "type": "string",
                                "value": "_serialize"
                              }
                            },
                            {
                              "type": "args",
                              "value": [
                                {
                                  "startLine": {
                                    "type": "int",
                                    "value": "11"
                                  },
                                  "endLine": {
                                    "type": "int",
                                    "value": "11"
                                  },
                                  "children": [
                                    {
                                      "type": "value",
                                      "value": {
                                        "startLine": {
                                          "type": "int",
                                          "value": "11"
                                        },
                                        "endLine": {
                                          "type": "int",
                                          "value": "11"
                                        },
                                        "children": [

