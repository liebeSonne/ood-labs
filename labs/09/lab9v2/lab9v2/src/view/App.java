package view;

import controller.*;
import document.DocumentInterface;
import observer.ObservedInterface;
import observer.ObserverInterface;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.ComponentAdapter;
import java.awt.event.ComponentEvent;

public class App extends JFrame implements ShapeDataViewInterface {
    public JPanel mainPanel;
    private JPanel canvasPanel;
    private JPanel instrumentPanel;
    private JButton rectangleButton;
    private JButton triangleButton;
    private JButton ellipseButton;
    private JButton UPDButton;

    private JPanel cPanel;

    DocumentInterface document;

    public App(DocumentInterface document) {
        super();

        this.document = document;

        this.initFrame();
        this.initMenu();
        this.initToolbar();
//        this.initCanvas();

        this.mainPanel.addComponentListener(new ComponentAdapter() {
            @Override
            public void componentResized(ComponentEvent e) {
                ((CanvasView)canvasPanel).redraw();
            }
        });

        UPDButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                ((CanvasView)canvasPanel).redraw();
            }
        });
    }

    private void initFrame() {
        this.setTitle("Editor Application");
        this.setContentPane(this.mainPanel);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        this.pack();
        this.setSize(800, 700);
    }

    private void initMenu() {
        MenuController menuController = new MenuController(document, this);
        MenuView menu = new MenuView(menuController);
        this.setJMenuBar(menu);
    }

    private void initToolbar() {
        ToolbarController toolbarController = new ToolbarController(document, this);
        this.instrumentPanel = new ToolbarView(toolbarController, this.rectangleButton, this.triangleButton, this.ellipseButton);
    }

    private void initCanvas() {
        CanvasController canvasController = new CanvasController(document, null);
        this.canvasPanel = new CanvasView(canvasController);
        canvasController.setCanvasDataView((CanvasDataVIewInterface) this.canvasPanel);
        ((ObservedInterface)document).register((ObserverInterface) this.canvasPanel);
    }

    private void createUIComponents() {
        this.initCanvas();
    }

    @Override
    public Point getCenter() {
        Point center = new Point(this.canvasPanel.getWidth() /2, this.canvasPanel.getHeight() / 2);
        return center;
    }

}
