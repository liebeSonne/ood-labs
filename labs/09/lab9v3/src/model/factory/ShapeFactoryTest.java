package model.factory;

import model.Shape;
import model.ShapeType;

import org.junit.Assert;
import org.junit.Test;

import java.awt.*;

public class ShapeFactoryTest {

    @Test
    public void createShape() {
        ShapeFactory factory = new ShapeFactory();

        Point center = new Point(10,20);

        Shape shape = factory.createShape(ShapeType.TRIANGLE, center);
        Shape shape2 = factory.createShape(ShapeType.ELLIPSE, center);
        Shape shape3 = factory.createShape(ShapeType.RECTANGLE, center);

        Assert.assertNotNull(shape);
        Assert.assertEquals(ShapeType.TRIANGLE, shape.getType());

        Assert.assertNotNull(shape2);
        Assert.assertEquals(ShapeType.ELLIPSE, shape2.getType());

        Assert.assertNotNull(shape3);
        Assert.assertEquals(ShapeType.RECTANGLE, shape3.getType());
    }

}
