package shape;

public enum ShapeType {
    ELLIPSE {
        @Override
        public String toString () {
            return "Ellipse";
        }
    },
    TRIANGLE {
        @Override
        public String toString () {
            return "Triangle";
        }
    },
    RECTANGLE {
        @Override
        public String toString () {
            return "Rectangle";
        }
    }
}
