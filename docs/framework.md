
```
@startuml

class TestCase {
    -IStep[] steps
    +string getTitle()
    +string getDescription()
    +ITestCaseResult run()
}

class Step {
    -callable impl
    +string getAction()
    +string getExpectedResult()
    +IStepResult run(ITestCaseResult $testCaseResult, $carry)
}

TestCase "1" *-- "*" Step

@enduml
```