package controller;

import canvas.CanvasInterface;
import document.DocumentInterface;
import shape.ShapeInterface;
import view.CanvasDataVIewInterface;

import java.awt.*;
import java.util.ArrayList;
import java.util.concurrent.atomic.AtomicReference;

public class CanvasController {
    DocumentInterface document;
    CanvasDataVIewInterface view;
    Point selectedPoint;

    public CanvasController(DocumentInterface document, CanvasDataVIewInterface view) {
        this.document = document;
        this.view = view;
    }

    public void setCanvasDataView(CanvasDataVIewInterface view) {
        this.view = view;
    }

    public void onClick(Point point) {
        System.out.println("onClick");
        this.selectedPoint = point;

        ArrayList<ShapeInterface> selectedShapes = new ArrayList<ShapeInterface>();

        AtomicReference<ShapeInterface> selectedShape = new AtomicReference<>();
        this.document.getShapes().forEach(shape -> {
            if (shape.contains(point)) {
                selectedShape.set(shape);
            }
        });

        if (selectedShape != null && selectedShape.get() != null) {
            selectedShapes.add(selectedShape.get());
        }

        this.document.setSelectedShapes(selectedShapes);
    }

    public void onDraggable(Point point) {
        System.out.println("onDraggable");
        if (this.selectedPoint != null) {
            int diffX = (point.x - this.selectedPoint.x);
            int diffY = (point.y - this.selectedPoint.y);

            this.document.getSelectedShapes().forEach(shape -> {
//                shape.translate(diffX, diffY);
                document.translateShape(shape, diffX, diffY);
            });
        }
    }

    public void onEndDraggable() {
        System.out.println("onEndDraggable");
        this.selectedPoint = null;
    }

    public void onDelete() {
        System.out.println("onDelete");
        this.document.getSelectedShapes().forEach(shape -> {
            this.document.removeShape(shape);
        });
    }

    public void onDraw() {
        System.out.println("onDraw");
        CanvasInterface canvas = this.view.getCanvas();
        this.document.getShapes().forEach(shape -> {
            shape.draw(canvas);
        });
    }
}
